<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\File as FileFacade; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\File; 
use App\Models\Article;
 
use App\Models\Editor;  
use App\Models\Review;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\AuthorNotifiedMail;
use App\Mail\ReviewerAssignedMail;
use Illuminate\Support\Facades\Auth;
class EditorialController extends Controller
{
    public function getPendingArticles()
    {
        // Lấy các bài viết có trạng thái đang chờ xử lý bởi Ban Trị Sự
        $articles = Article::where('status', 'Pending_editor')->get();

        return response()->json([
            'status' => 200,
            'data' => $articles,
        ]);
    }
    public function getReviewer(Request $request)
    {
        // Lấy ID từ query string (nếu có)
        $id = $request->query('id');
    
        // Tìm danh sách users có role là 3
        $query = User::where('role', '3');
    
        // Nếu truyền ID qua query string, lọc theo ID
        if ($id) {
            $query->where('id', $id);
        }
    
        $users = $query->get();
    
        // Kiểm tra nếu không có user nào được tìm thấy
        if ($users->isEmpty()) {
            return response()->json([
                'status' => 404,
                'message' => 'No reviewers found.',
            ]);
        }
    
        // Tạo danh sách reviewers
        $reviewers = $users->map(function ($user) {
            return [
                'id' => $user->id,
                'name' => trim($user->first_name . ' ' . $user->last_name),
                'email' => $user->email,
            ];
        });
        
        // Trả về danh sách reviewers
        return response()->json([
            'status' => 200,
            'data' => $reviewers,
        ]);
    }
    

    public function assignReviewer(Request $request)
    {
        // Xác thực dữ liệu đầu vào
        $validated = $request->validate([
            'article_id' => 'required|exists:articles,article_id',
            'reviewer_id' => 'required|exists:users,id',
            'submission_date'=>'required|date',
            'evaluation'=>'string'
        ]);

        // Kiểm tra xem bài viết đã được phân công cho người phản biện này chưa
        $existingReview = Review::where('article_id', $validated['article_id'])
            ->where('reviewer_id', $validated['reviewer_id'])
            ->first();

        if ($existingReview) {
            return response()->json([
                'status' => 409,
                'message' => 'Reviewer is already assigned to this article.',
            ]);
        }
        //Cập nhật trạng thái lại bảng bài viết
        $article = Article::find($validated['article_id']);
        $article->update(['status' => 'Pending_Review']);
        // Tạo bản ghi phân công phản biện
        $review = Review::create([
            'article_id' => $validated['article_id'],
            'reviewer_id' => $validated['reviewer_id'],
            'evaluation'=>$validated['evaluation']??null,
            'submission_date' => $validated['submission_date'],
            'acceptance_date'=> now(),
        ]);
        
        // Gửi email cho người phản biện
        $reviewer = User::find($validated['reviewer_id']);
        Mail::to($reviewer->email)->send(new ReviewerAssignedMail($review));

        // Gửi email cho tác giả
        $article = Article::find($validated['article_id']);   
        Mail::to($article->user->email)->send(new AuthorNotifiedMail($article));
            
        
        return response()->json([
            'status' => 200,
            'message' => 'Reviewer assigned successfully.',
            'data' => $review,
        ]);
    }
    public function getByStatus(Request $request)    
    {
        // Lấy trạng thái từ yêu cầu (query parameter)
        $status = $request->query('status');

        // Kiểm tra nếu có giá trị trạng thái, thực hiện tìm kiếm
        if ($status) {
            $articles = Article::where('status', $status)
                ->with(['reviews' => function ($query) {
                    // Lấy thông tin trạng thái review
                    $query->select('article_id', 'status', 'evaluation');
                }])
                ->get();
        } else {
            // Nếu không có trạng thái, trả về toàn bộ danh sách bài viết cùng thông tin review
            $articles = Article::with(['reviews' => function ($query) {
                $query->select('article_id', 'status', 'evaluation');
            }])->get();
        }

        return response()->json([
            'status' => 200,
            'data' => $articles,
        ]);
    }

    public function capnhatQuyen(Request $request, $id)
{
    // Lấy tham số 'role' từ query string
    $role = $request->query('role');

    // Kiểm tra nếu role không được cung cấp
    if (!$role) {
        return response()->json([
            'success' => false,
            'message' => 'Vui lòng cung cấp tham số role.',
        ], 400);
    }

    // Tìm user theo ID
    $user = User::find($id);

    // Kiểm tra nếu user không tồn tại
    if (!$user) {
        return response()->json([
            'success' => false,
            'message' => 'Người dùng không tồn tại.',
        ], 404);
    }

    // Cập nhật quyền
    $user->role = $role;
    $user->save();

    return response()->json([
        'success' => true,
        'message' => 'Cập nhật quyền thành công.',
        'data' => $user,
    ]);
}
public function showOrDownloadFile($article_id, $action = 'view')
    {
        // Tìm file theo article_id
        $file = File::where('article_id', $article_id)->first();

        // Kiểm tra nếu file tồn tại
        if ($file && Storage::exists('public/' . $file->file_path)) {
            // Đường dẫn tuyệt đối đến file
            $filePath = storage_path('app/public/' . $file->file_path);
            
            // Lấy MIME type của file
            $mimeType = FileFacade::mimeType($filePath);

            if ($action == 'download') {
                // Trả về file để tải về
                return response()->download($filePath, $file->file_name, [
                    'Content-Type' => $mimeType
                ]);
            }

            // Trả về file để xem trực tiếp trong trình duyệt
            return response()->file($filePath, [
                'Content-Type' => $mimeType
            ]);
        }

        // Nếu không tìm thấy file, trả về lỗi
        return response()->json(['error' => 'File not found'], 404);
    }

    
}
