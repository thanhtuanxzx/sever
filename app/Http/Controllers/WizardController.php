<?php

namespace App\Http\Controllers;

use App\Models\User; // Thêm dòng này nếu User ở thư mục Models
use App\Models\Article;
use App\Models\Keyword;
use App\Models\Citation;
use App\Models\ArticleAuthor;
use App\Models\SubmissionProgress;
use App\Models\Notification;
use App\Models\File;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log; 
use Illuminate\Support\Facades\Storage;
use App\Notifications\CoAuthorAddedNotification;
use Illuminate\Support\Facades\Mail;
use App\Mail\CoAuthorAdded; 
class WizardController extends Controller
   
{
    public function getAuthorIdByBaiVietId($idArticle)
    {
        // Lấy các tác giả của bài viết từ bảng ArticleAuthor và eager load thông tin user
        $articleauthor = ArticleAuthor::where('article_id', $idArticle)->with('user')->get();
        

        if ($articleauthor->isEmpty()) {

            return response()->json(['status' => 404, 'error' => 'Không có tác giả nào cho bài viết này'], 404);
        }
        
        // Mảng lưu kết quả
        $result = [];
    
        // Duyệt qua từng tác giả
        foreach ($articleauthor as $coAuthor) {

            if ($coAuthor->user) {
  
      
         
                $result[] = [
                    'first_name' => $coAuthor->user->first_name, // Lấy first_name từ bảng User
                    'last_name' => $coAuthor->user->last_name,  // Lấy last_name từ bảng User
                    'email' => $coAuthor->user->email,          // Lấy email từ bảng User
                    'role' => $coAuthor->role,                   // Lấy role từ bảng ArticleAuthor
                ];
            } else {
              
                $result[] = [
                    'first_name' => 'Không có tên',
                    'last_name' => 'Không có tên',
                    'email' => 'Không có email',
                    'role' => $coAuthor->role,
                ];
            }
        }

   
        // Trả về kết quả dưới dạng JSON
        return response()->json([
            'status' => 200,
            'data' => $result
        ], 200);
    }

    public function getUserArticleFiles(Request $request)
{
    // Lấy ID người dùng hiện tại
    $userId = auth()->id();

    if (!$userId) {
        return response()->json([
            'status' => 401,
            'error' => 'Người dùng chưa được xác thực'
        ], 401);
    }

    // Validate article_id từ request
    $request->validate([
        'article_id' => 'required|integer'
    ]);

    // Lấy article_id từ request
    $articleId = $request->input('article_id');

    // Kiểm tra bài viết có thuộc người dùng hiện tại không
    $article = Article::where('article_id', $articleId)
        ->where('user_id', $userId)
        ->first();

    if (!$article) {
        return response()->json([
            'status' => 403,
            'error' => 'Bài viết không tồn tại hoặc không thuộc về người dùng này'
        ], 403);
    }

    // Lấy danh sách file có article_id khớp
    $files = File::where('article_id', $articleId)->get();

    // Trả về dữ liệu
    return response()->json([
        'status' => 200,
        'data' => $files
    ], 200);
}


    

    public function getUserByEmail(Request $request)
    {
        // Xác thực email
        $request->validate([
            'email' => 'required|email',
        ]);
    
        // Tìm người dùng theo email
        $user = User::where('email', $request->email)->first();
    
        // Nếu tìm thấy, trả về thông tin
        if ($user) {
            return response()->json([
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
            ]);
        } else {
            // Nếu không tìm thấy, trả về lỗi
            return response()->json(['status' => 404, 'error' => 'User not found.'], 404);
        }
    }
    
    public function show()
    {  
        $userId = Auth::id(); 
    
     
        if (!$userId) {
            return response()->json(['status' => 401, 'error' => 'User not authenticated'], 401);
        }
    

       $article = Article::where('user_id', $userId) // Lọc theo user_id
            ->whereHas('SubmissionProgress', function ($query) {
                $query->where('current_step', '<', 4); // Chỉ lấy current_step < 5
            })->get();
    
        // Trả về dữ liệu dưới dạng JSON
        return response()->json($article);
    }

    
    public function show1()
    {
        $userId = Auth::id(); // Lấy ID người dùng đã xác thực
    
        // Kiểm tra người dùng có xác thực hay không
        if (!$userId) {
            return response()->json(['status' => 401, 'error' => 'User not authenticated'], 401);
        }
    
        // Lấy danh sách bài viết với current_step = 4 của người dùng hiện tại
       $article = Article::where('user_id', $userId) // Lọc theo user_id
            ->whereHas('SubmissionProgress', function ($query) {
                $query->where('current_step', '=', 4); 
            })->get();
    
        // Trả về dữ liệu dưới dạng JSON
        return response()->json($article);
    }
    public function getTukhoa($article_id, Request $request) {
        // Lọc theo article_id
        $query = Keyword::where('article_id', $article_id);
    
        // Kiểm tra nếu có tham số keyword_id trong query parameters
        if ($request->has('keyword_id')) { // Sửa lại keywork_id thành keyword_id nếu cần
            $keyword_id = $request->query('keyword_id');
            $query->where('keyword_id', $keyword_id); // Assuming `id` is the correct column for keyword_id
        }
    
        // Lấy kết quả từ database
        $keywords = $query->get();
    
        // Kiểm tra nếu không có kết quả nào
        if ($keywords->isEmpty()) {
            return response()->json(['status' => 404, 'message' => 'Không tìm thấy từ khóa nào'], 404);
        }
    
        // Trả về dữ liệu dưới dạng JSON
        return response()->json([
            'status' => 200,
            'data' => $keywords
        ], 200);
    }
    
    public function getCategory(Request $request)
    {
        // Nếu có các query parameter, bạn có thể áp dụng chúng để lọc dữ liệu
        $query = Category::query();

        // Kiểm tra các query parameters để lọc dữ liệu
        if ($request->has('category_id')) {
            $query->where('category_id', $request->input('category_id'));
        }

       
        // Trả về kết quả dưới dạng JSON
        return response()->json($query->get());
    }
    public function getSubmissions(Request $request)
    {
        // Lấy ID người dùng hiện tại
        $userId = auth()->id();
    
        if (!$userId) {
            return response()->json(['message' => 'Người dùng chưa được xác thực'], 401);
        }
    
        // Lấy các tham số từ request
        $idArticle = $request->query('article_id');
        $idCategory = $request->query('category_id');
        $volume = $request->query('volume');
    
        // Tạo query builder để lọc dữ liệu
        $query = Article::query();
    
        // Áp dụng điều kiện lọc bài viết thuộc về người dùng hiện tại
        $query->where('user_id', $userId);
    
        // Áp dụng các điều kiện lọc dựa vào các tham số
        if ($idArticle) {
            $query->where('article_id', $idArticle); // Sửa 'article_id' thành 'id'
        }
    
        if ($idCategory) {
            $query->where('category_id', $idCategory);
        }
    
        if ($volume) {
            $query->where('volume', $volume);
        }
    
        // Lấy kết quả sau khi áp dụng điều kiện
        $articles = $query->get();
    
        // Kiểm tra nếu không tìm thấy kết quả nào
        if ($articles->isEmpty()) {
            return response()->json(['message' => 'Không tìm thấy bài viết'], 404);
        }
    
        // Trả về dữ liệu bài viết kèm theo current_step
        $result = $articles->map(function ($article) {
            // Lấy đối tượng SubmissionProgress đầu tiên
            $submissionProgress = $article->SubmissionProgress()->first();
    
            // Kiểm tra nếu SubmissionProgress tồn tại, lấy current_step
            $currentStep = $submissionProgress ? $submissionProgress->current_step : null;
    
            return [
                'data' => $article,
                'current_step' => $currentStep,
            ];
        });
    
        return response()->json($result, 200);
    }
    
    
    
    public function storeStep1(Request $request, $article_id = null)
    {
        // Validate the incoming request
        $request->validate([
            'note' => 'required|string',
            'category_id' => 'required|string|max:255',
        ]);
    
        // Get the authenticated user ID
        $userId = Auth::id();
    
        // Check if the user is authenticated
        if (!$userId) {
            return response()->json(['status' => 401, 'error' => 'User not authenticated'], 401);
        }
    
        // Validate the category ID
        $category = Category::where('category_id', $request->input('category_id'))->first();
        if (!$category) {
            return response()->json(['status' => 401, 'error' => 'Chuyên đề không phù hợp'], 401);
        }
    
        if ($article_id) {
            // If article_id is provided, update the article
            $article = Article::find($article_id);
    
            if ($article && $article->user_id === $userId) {
                // Update the article
                $article->update([
                    'note' => $request->input('note'),
                    'category_id' => $category->category_id,
                ]);
    
                // Update or create submission progress
                $progress = SubmissionProgress::where('user_id', $userId)
            ->where('article_id', $article->article_id)
            ->first();
    
        // If no progress record exists, create a new one
        if (!$progress) {
            SubmissionProgress::create([
                'user_id' => $userId,
                'article_id' => $article->article_id,
                'current_step' => 1
            ]);
        }
    
                return response()->json([
                    'status' => 200,
                    'message' => 'Bài viết đã được cập nhật thành công',
                    'article_id' => $article->article_id
                ], 200);
            }
    
            return response()->json(['error' => 'Bài viết không tồn tại hoặc bạn không có quyền sửa bài viết này'], 403);
        }
    
        // If no article_id is provided, create a new article
        $article = Article::create([
            'note' => $request->input('note'),
            'user_id' => $userId,
            'category_id' => $category->category_id,
        ]);
    
        // Check if a progress record already exists for this article and user
        $progress = SubmissionProgress::where('user_id', $userId)
            ->where('article_id', $article->article_id)
            ->first();
    
        // If no progress record exists, create a new one
        if (!$progress) {
            SubmissionProgress::create([
                'user_id' => $userId,
                'article_id' => $article->article_id,
                'current_step' => 1
            ]);
        }
    
        return response()->json([
            'status' => 201,
            'message' => 'Bước 1 đã lưu thành công',
            'article_id' => $article->article_id
        ], 201);
    }
    
    
    

    // public function storeStep2(Request $request, $article_id = null)
    // {
    //     $userId = Auth::id();

    //     if (!$userId) {
    //         return response()->json(['status' => 401,'error' => 'User not authenticated'], 401);
    //     }

    //     // Lấy tiến trình của người dùng
    //     $progress = SubmissionProgress::where('user_id', $userId)
    //         ->where('article_id', $article_id)
    //         ->first();
    
    //     if (!$progress) {
    //         return response()->json(['status' => 404,'error' => 'Tiến trình không tồn tại'], 404);
    //     }
    
    //     // Lấy bài viết dựa trên article_id
    //    $article = Article::find($article_id);
    
    //     if (!$article ||$article->user_id !== $userId) {
    //         return response()->json(['status' => 403,'error' => 'Bạn không có quyền sửa bài viết này hoặc bài viết không tồn tại'], 403);
    //     }

    //     // Validate file tải lên
    //     $request->validate([
    //         'file' => 'nullable|file|max:2048',
    //     ]);

       
    
    //     // Xử lý file upload nếu có file mới được tải lên
    //     if ($request->hasFile('file')) {
    //         $file = $request->file('file');
    
    //         // Xóa file cũ nếu tồn tại
    //         if ($article->generated_name) {
    //             Storage::disk('public')->delete('uploads/' .$article->generated_name);
    //         }
    
    //         // Tạo tên file mới và lưu trữ file
    //         $generatedFileName = Str::random(20) . '.' . $file->getClientOriginalExtension();
    //         $filePath = $file->storeAs('uploads', $generatedFileName, 'public');
    
    //         // Cập nhật thông tin file vào bài viết
    //        $article->update([
    //             'original_name' => $file->getClientOriginalName(),
    //             'generated_name' => $generatedFileName,
    //         ]);
    
    //         return response()->json(['status' => 300,'message' => 'File tải lên thành công và bài viết đã được cập nhật']);
    //     }

    //     return response()->json(['status' => 200,'message' => 'Không có file nào được tải lên'], 200);
    // }

    // public function storeStep2(Request $request,$articleId = null)
    // {
    //     $userId = Auth::id();
    
    //     // Kiểm tra người dùng có xác thực hay không
    //     if (!$userId) {
    //         return response()->json(['status' => 401, 'error' => 'User not authenticated'], 401);
    //     }
        
    //     // Tìm bài viết
        
    //     $article = Article::find($articleId); // Correct usage
        
    
    //     // Kiểm tra bài viết có tồn tại và thuộc về người dùng không
    //     if (!$article ||$article->user_id !== $userId) {
    //         return response()->json(['status' => 403, 'error' => 'Bạn không có quyền sửa bài viết này hoặc bài viết không tồn tại'], 403);
    //     }
    
    //     // Validate các file đã tải lên
    //     $request->validate([
    //         'file.*' => 'file|max:2048', // Cho phép nhiều file
    //     ]);
    
    //     // Nếu có file mới được tải lên
    //     if ($request->hasFile('file')) {
    //         // Lấy tất cả file cũ
    //         $oldFiles = File::where('article_id',$articleId)->get();
    
    //         // Xóa tất cả file cũ
    //         foreach ($oldFiles as $oldFile) {
    //             $oldFilePath = 'uploads/' . $oldFile->generated_name;
    
    //             // Xóa file nếu tồn tại
    //             if (Storage::disk('public')->exists($oldFilePath)) {
    //                 Storage::disk('public')->delete($oldFilePath);
    //             }
    
    //             // Xóa bản ghi trong cơ sở dữ liệu
    //            File::where('article_id',$articleId)->delete();
    //         }
    
    //         // Lưu file mới
    //         $files = $request->file('file');
    
    //         // Nếu chỉ một file được tải lên, chuyển đổi nó thành mảng để xử lý nhất quán
    //         if (!is_array($files)) {
    //             $files = [$files];
    //         }
    
    //         foreach ($files as $file) {
    //             // Tạo tên file mới
    //             $generatedFileName = Str::random(20) . '.' . $file->getClientOriginalExtension();
    //             $filePath = $file->storeAs('uploads', $generatedFileName, 'public');
    
    //             // Tạo hoặc cập nhật thông tin file trong cơ sở dữ liệu
    //             File::updateOrCreate(
    //                 ['article_id' =>$articleId, 'generated_name' => $generatedFileName],
    //                 [
    //                     'file_name' => $file->getClientOriginalName(),
    //                     'file_path' => $filePath,
    //                     'file_mime_type' => $file->getMimeType(),
    //                 ]
    //             );
    //         }
    //         $progress = SubmissionProgress::where('user_id', $userId)
    //         ->where('article_id', $article->article_id)
    //         ->first();

    //         if ($progress) {
    //             // Kiểm tra bước hiện tại và cập nhật tiến trình
    //             if ($progress->current_step <= 2) {
    //                 // Cập nhật current_step cho tiến trình
    //                 $progress->update(['current_step' => 2]);
    //             } else {
                
    //         }
    //     }
      
    //         return response()->json(['status' => 200, 'message' => 'Các tệp đã được tải lên thành công và bài viết đã được cập nhật']);
    //     }
    
    //     return response()->json(['status' => 200, 'message' => 'Không có tệp nào được tải lên'], 200);
    // }
    public function storeStep2(Request $request, $articleId = null)
    {
        $userId = Auth::id();

        // Kiểm tra người dùng có xác thực hay không
        if (!$userId) {
            return response()->json(['status' => 401, 'error' => 'User not authenticated'], 401);
        }

        // Tìm bài viết
        $article = Article::find($articleId);

        // Kiểm tra bài viết có tồn tại và thuộc về người dùng không
        if (!$article || $article->user_id !== $userId) {
            return response()->json(['status' => 403, 'error' => 'Bạn không có quyền sửa bài viết này hoặc bài viết không tồn tại'], 403);
        }

        // Validate các file đã tải lên
        $request->validate([
            'file.*' => 'file|max:2048', // Cho phép nhiều file
        ]);

        // Nếu có file mới được tải lên
        if ($request->hasFile('file')) {
            // Kiểm tra nếu bài viết đã có tệp
            $oldFiles = File::where('article_id', $articleId)->get();

            if ($oldFiles->isEmpty()) {
                // Nếu chưa có tệp nào, gọi phương thức POST
                return $this->postFile($request, $articleId);
            } else {
                // Nếu đã có tệp, gọi phương thức PUT (cập nhật)
                return $this->updateFile($request, $articleId);
            }
        }

        return response()->json(['status' => 200, 'message' => 'Không có tệp nào được tải lên'], 200);
    }

    public function postFile(Request $request, $articleId = null)
    {
        $userId = Auth::id();

        // Kiểm tra người dùng có xác thực hay không
        if (!$userId) {
            return response()->json(['status' => 401, 'error' => 'User not authenticated'], 401);
        }

        // Tìm bài viết
        $article = Article::find($articleId);

        // Kiểm tra bài viết có tồn tại và thuộc về người dùng không
        if (!$article || $article->user_id !== $userId) {
            return response()->json(['status' => 403, 'error' => 'Bạn không có quyền sửa bài viết này hoặc bài viết không tồn tại'], 403);
        }

        // Validate các file đã tải lên
        $request->validate([
            'file.*' => 'file|max:2048', // Cho phép nhiều file
        ]);

        // Nếu có file mới được tải lên
        if ($request->hasFile('file')) {
            // Lưu file mới
            $files = $request->file('file');

            // Nếu chỉ một file được tải lên, chuyển đổi nó thành mảng để xử lý nhất quán
            if (!is_array($files)) {
                $files = [$files];
            }

            foreach ($files as $file) {
                // Tạo tên file mới
                $generatedFileName = Str::random(20) . '.' . $file->getClientOriginalExtension();
                $filePath = $file->storeAs('uploads', $generatedFileName, 'public');

                // Tạo thông tin file trong cơ sở dữ liệu
                File::create([
                    'article_id' => $articleId,
                    'generated_name' => $generatedFileName,
                    'file_name' => $file->getClientOriginalName(),
                    'file_path' => $filePath,
                    'file_mime_type' => $file->getMimeType(),
                ]);
            }

            // Cập nhật tiến trình nếu cần
            $progress = SubmissionProgress::where('user_id', $userId)
                ->where('article_id', $article->article_id)
                ->first();

            if ($progress && $progress->current_step <= 2) {
                $progress->update(['current_step' => 2]);
            }

            return response()->json(['status' => 200, 'message' => 'Các tệp đã được tải lên thành công và bài viết đã được cập nhật']);
        }

        return response()->json(['status' => 200, 'message' => 'Không có tệp nào được tải lên'], 200);
    }

    public function updateFile(Request $request, $articleId = null)
    {
        $userId = Auth::id();

        // Kiểm tra người dùng có xác thực hay không
        if (!$userId) {
            return response()->json(['status' => 401, 'error' => 'User not authenticated'], 401);
        }

        // Tìm bài viết
        $article = Article::find($articleId);

        // Kiểm tra bài viết có tồn tại và thuộc về người dùng không
        if (!$article || $article->user_id !== $userId) {
            return response()->json(['status' => 403, 'error' => 'Bạn không có quyền sửa bài viết này hoặc bài viết không tồn tại'], 403);
        }

        // Validate các file đã tải lên
        $request->validate([
            'file.*' => 'file|max:2048', // Cho phép nhiều file
        ]);

        // Nếu có file mới được tải lên
        if ($request->hasFile('file')) {
            // Lấy tất cả file cũ
            $oldFiles = File::where('article_id', $articleId)->get();

            // Xóa tất cả file cũ
            foreach ($oldFiles as $oldFile) {
                $oldFilePath = 'uploads/' . $oldFile->generated_name;

                // Xóa file nếu tồn tại
                if (Storage::disk('public')->exists($oldFilePath)) {
                    Storage::disk('public')->delete($oldFilePath);
                }

                // Xóa bản ghi trong cơ sở dữ liệu
                $oldFile->delete();
            }

            // Lưu file mới
            $files = $request->file('file');

            // Nếu chỉ một file được tải lên, chuyển nó thành mảng để xử lý nhất quán
            if (!is_array($files)) {
                $files = [$files];
            }

            foreach ($files as $file) {
                // Tạo tên file mới
                $generatedFileName = Str::random(20) . '.' . $file->getClientOriginalExtension();
                $filePath = $file->storeAs('uploads', $generatedFileName, 'public');

                // Tạo hoặc cập nhật thông tin file trong cơ sở dữ liệu
                File::updateOrCreate(
                    ['article_id' => $articleId, 'generated_name' => $generatedFileName],
                    [
                        'file_name' => $file->getClientOriginalName(),
                        'file_path' => $filePath,
                        'file_mime_type' => $file->getMimeType(),
                    ]
                );
            }

            // Cập nhật tiến trình nếu cần
            $progress = SubmissionProgress::where('user_id', $userId)
                ->where('article_id', $article->article_id)
                ->first();

            if ($progress && $progress->current_step <= 2) {
                $progress->update(['current_step' => 2]);
            }

            return response()->json(['status' => 200, 'message' => 'Các tệp đã được cập nhật thành công']);
        }

        return response()->json(['status' => 200, 'message' => 'Không có tệp nào được tải lên'], 200);
    }


    
   
    // public function storeStep3(Request $request, $article_id = null)
    // {
    //     $userId = Auth::id();
    
    //     if (!$userId) {
    //         return response()->json(['status' => 401, 'error' => 'User not authenticated'], 401);
    //     }
    
    //     $request->validate([
    //         'title' => 'required|string|max:255',
    //         'abstract' => 'nullable|string|max:250',
    //         'keyword' => 'nullable|string',
    //         'citations' => 'nullable|string', // Make citations nullable
    
    //         'coAuthors' => 'nullable|array',
    //         'coAuthors.*.name' => 'required|string',
    //         'coAuthors.*.email' => 'required|email',
    //         'coAuthors.*.role' => 'required|string',
    //     ]);
    
    //     // Lấy tiến trình của người dùng
    //     $progress = SubmissionProgress::where('user_id', $userId)
    //         ->where('article_id', $article_id)
    //         ->first();
  
    //     if (!$progress) {
    //         return response()->json(['status' => 404, 'error' => 'Tiến trình không tồn tại'], 404);
    //     }
    
    //     // Lấy bài viết dựa trên article_id
    //     $article = Article::find($article_id);
    
    //     if (!$article || $article->user_id !== $userId) {
    //         return response()->json(['status' => 403, 'error' => 'Bạn không có quyền sửa bài viết này hoặc bài viết không tồn tại'], 403);
    //     }
    
    //     // Cập nhật thông tin bài viết
    //     $article->update([
    //         'title' => $request->input('title'),
    //         'abstract' => $request->input('abstract'),
    //         'citations' => $request->input('citations'),
    //     ]);
    
    //     // Xử lý từ khóa
    //     if ($request->filled('keyword')) {
    //         $keywords = preg_split('/\r\n|\r|\n/', $request->input('keyword')); // Tách từ khóa vào mảng
    //         foreach ($keywords as $keyword) { // Dùng biến đúng tên là $keywords
    //             $keyword = trim($keyword); // Loại bỏ khoảng trắng thừa
    //             if (!empty($keyword)) { // Kiểm tra nếu từ khóa không rỗng
    //                 Keyword::create([ // Tạo mới bản ghi từ khóa
    //                     'article_id' => $article->article_id, // Use $article->id
    //                     'keyword' => $keyword
    //                 ]);
    //             }
    //         }
    //     }
         
    //     // Xử lý đồng tác giả
    //     if ($request->has('coAuthors')) {
    //         foreach ($request->input('coAuthors') as $coAuthor) {
    //             $user = User::where('email', $coAuthor['email'])->first();
    
    //             if ($user) {
    //                 // Kiểm tra xem đồng tác giả đã tồn tại hay chưa
    //                 $existingCoAuthor = ArticleAuthor::where('author_id', $user->id)
    //                     ->where('article_id', $article->article_id) // Use $article->id
    //                     ->first();
    
    //                 if (!$existingCoAuthor) {
    //                     ArticleAuthor::create([
    //                         'author_id' => $user->id,
    //                         'article_id' => $article->article_id, // Use $article->id
    //                         'role' => $coAuthor['role'],
    //                     ]);
    //                     // Gửi thông báo cho đồng tác giả
    //                     $notification = Notification::create([
    //                         'user_id' => $user->id,
    //                         'title' => 'Bạn đã được thêm làm đồng tác giả',
    //                         'message' => "Bạn đã được thêm làm đồng tác giả của bài viết: \"{$article->title}\".",
    //                         'url' => url("/articles/{$article->article_id}"),
    //                     ]);
                    
                       
    //                 } else {
    //                     // You might want to continue with the next co-author if one already exists
    //                     continue; // Skip and continue to the next co-author
    //                 }
    //             } else {
    //                 return response()->json(['status' => 404, 'error' => "Không tìm thấy người dùng với email: {$coAuthor['email']}"], 404);
    //             }
    //         }
    //     }
        
    //     $progress = SubmissionProgress::where('user_id', $userId)
    //     ->where('article_id', $article->article_id)
    //     ->first();

    //     if ($progress) {
    //         // Kiểm tra bước hiện tại và cập nhật tiến trình
    //         if ($progress->current_step <=3) {
    //             // Cập nhật current_step cho tiến trình
    //             $progress->update(['current_step' => 3]);
    //         } else {
    //             // Nếu đã qua bước 3, chỉ cập nhật
            
            
    //         }
    //     }
    //     return response()->json(['status' => 200, 'message' => 'Bài viết và đồng tác giả đã được cập nhật thành công']);
    // }
    public function storeOrUpdateStep3(Request $request, $article_id)
    {
        $userId = Auth::id();

        if (!$userId) {
            return response()->json(['status' => 401, 'error' => 'User not authenticated'], 401);
        }

        // Kiểm tra tiến trình của người dùng
        $progress = SubmissionProgress::where('user_id', $userId)->first();

        if (!$progress) {
            return response()->json(['status' => 400, 'error' => 'Không tìm thấy tiến trình của bài viết'], 400);
        }

        if ($progress->current_step < 2) {
            return response()->json([
                'status' => 400,
                'error' => 'Tiến trình hiện tại không đủ điều kiện để thực hiện thao tác này. Vui lòng hoàn thành các bước trước đó'
            ], 400);
        }

        // Validate dữ liệu
        $request->validate([
            'title' => 'required|string|max:255',
            'abstract' => 'nullable|string|max:250',
            'keyword' => 'nullable|string',
            'citations' => 'nullable|string',
            'coAuthors' => 'nullable|array',
            'coAuthors.*.name' => 'required|string',
            'coAuthors.*.email' => 'required|email|distinct',
            'coAuthors.*.role' => 'required|string',
        ]);

        $loggedInUserEmail = Auth::user()->email;

        foreach ($request->input('coAuthors', []) as $coAuthor) {
            $user = User::where('email', $coAuthor['email'])->first();
            if (!$user) {
                return response()->json(['status' => 400, 'error' => 'Email của đồng tác giả không tồn tại trong hệ thống.'], 400);
            }
            if ($coAuthor['email'] == $loggedInUserEmail) {
                return response()->json(['status' => 400, 'error' => 'Email của đồng tác giả không thể trùng với email của tác giả chính'], 400);
            }
        }

        // Tìm bài viết
        $article = Article::find($article_id);

        if (!$article || $article->user_id !== $userId) {
            return response()->json(['status' => 403, 'error' => 'Bạn không có quyền sửa bài viết này hoặc bài viết không tồn tại'], 403);
        }

        // Cập nhật thông tin bài báo
        $article->update([
            'title' => $request->input('title'),
            'abstract' => $request->input('abstract'),
            'citations' => $request->input('citations'),
        ]);

        // Cập nhật từ khóa
        if ($request->filled('keyword')) {
            // Xóa các từ khóa cũ
            Keyword::where('article_id', $article->article_id)->delete();

            // Cập nhật từ khóa mới
            $keywords = preg_split('/\r\n|\r|\n/', $request->input('keyword'));
            foreach ($keywords as $keyword) {
                $keyword = trim($keyword);
                if (!empty($keyword)) {
                    Keyword::create([
                        'article_id' => $article->article_id,
                        'keyword' => $keyword,
                    ]);
                }
            }
        }

        // Cập nhật đồng tác giả
        if ($request->has('coAuthors')) {
            // Xóa đồng tác giả cũ
            ArticleAuthor::where('article_id', $article->article_id)->delete();

            // Thêm đồng tác giả mới
            foreach ($request->input('coAuthors', []) as $coAuthor) {
                $user = User::where('email', $coAuthor['email'])->first();
                if ($user) {
                    ArticleAuthor::create([
                        'author_id' => $user->id,
                        'article_id' => $article->article_id,
                        'role' => $coAuthor['role'],
                    ]);

                    // Gửi email thông báo cho đồng tác giả
                    Mail::to($user->email)->send(new CoAuthorAdded($user, $article));
                }
            }
        }

        // Đảm bảo tác giả chính được cập nhật (hoặc thêm nếu chưa có)
        ArticleAuthor::updateOrCreate(
            ['article_id' => $article->article_id, 'author_id' => $userId],
            ['role' => 'Chính']
        );

        return response()->json([
            'status' => 200,
            'message' => 'Bài viết đã được cập nhật thành công',
        ]);
    }

    
    

        
    

    public function storeStep4(Request $request, $article_id = null)
    {
        $userId = Auth::id();

        if (!$userId) {
            return response()->json(['status' => 401,'error' => 'User not authenticated'], 401);
        }

        // Lấy tiến trình của người dùng
        $progress = SubmissionProgress::where('user_id', $userId)
            ->where('article_id', $article_id)
            ->first();
    
        if (!$progress) {
            return response()->json(['status' => 404,'error' => 'Tiến trình không tồn tại'], 404);
        }
    
        // Lấy bài viết dựa trên article_id
       $article = Article::find($article_id);
    
        if (!$article ||$article->user_id !== $userId) {
            return response()->json(['status' => 403,'error' => 'Bạn không có quyền sửa bài viết này hoặc bài viết không tồn tại'], 403);
        }

        $progress->update(['current_step' => 4]);

        return response()->json(['status' => 200,'message' => 'Bước 4 đã lưu thành công'], 200);
    }

    //Cập nhật thông tin đông tác giả
    public function storeStep3_(Request $request, $article_id = null)
    {
        // Xác thực dữ liệu đầu vào
        $request->validate([
            'coAuthors' => 'nullable|array',
            'coAuthors.*.name' => 'required|string',
            'coAuthors.*.email' => 'required|email',
            'coAuthors.*.role' => 'required|string',
        ]);
        
        // Lấy thông tin bài viết dựa trên article_id
        $article = Article::find($article_id);
        
        if (!$article) {
            return response()->json(['status' => 404, 'error' => 'Bài viết không tồn tại'], 404);
        }
    
        // Duyệt qua từng đồng tác giả và xử lý
        if ($request->has('coAuthors')) {
            foreach ($request->input('coAuthors') as $coAuthor) {
                // Tìm người dùng theo email của đồng tác giả
                $user = User::where('email', $coAuthor['email'])->first();
    
                if ($user) {
                    // Kiểm tra và cập nhật hoặc tạo mới bản ghi đồng tác giả
                    $articleAuthor = ArticleAuthor::updateOrCreate(
                        [
                            'author_id' => $user->id,
                            'article_id' => $article->article_id, // Sử dụng đúng article_id
                        ],
                        [
                            'role' => $coAuthor['role'],
                        ]
                    );
    
                    // Gửi thông báo cho đồng tác giả
                    $notification = Notification::create([
                        'user_id' => $user->id,
                        'title' => 'Bạn đã được thêm hoặc cập nhật làm đồng tác giả',
                        'message' => "Bạn đã được thêm hoặc cập nhật làm đồng tác giả của bài viết: \"{$article->title}\".",
                        'url' => url("/articles/{$article->article_id}"),
                    ]);
    
                    // Phát thông báo real-time qua Pusher (nếu cần)
                    // broadcast(new CoAuthorAdded($user->id, $notification));
    
                } else {
                    // Nếu không tìm thấy người dùng với email, trả về lỗi
                    return response()->json(['status' => 404, 'error' => "Không tìm thấy người dùng với email: {$coAuthor['email']}"], 404);
                }
            }
        }
    
        // Trả về phản hồi thành công
        return response()->json(['status' => 200, 'message' => 'Đồng tác giả đã được cập nhật hoặc thêm thành công']);
    }

    public function update_a(Request $request, $article_id = null)
    {
        // Xác thực dữ liệu đầu vào
        $request->validate([
            'note' => 'required|string',
            'keyword' => 'nullable|string',
            'citations' => 'nullable|string', 
        ]);
        
        // Lấy thông tin bài viết từ database
        $article = Article::find($article_id);
        
        if (!$article) {
            return response()->json(['status' => 404, 'error' => 'Bài viết không tồn tại'], 404);
        }
    
        // Cập nhật thông tin bài viết
        $article->update([
            'note' => $request->input('note'),
            'citations' => $request->input('citations'),
        ]);
    
        // Xử lý từ khóa nếu có
        if ($request->filled('keyword')) {
            // Tách từ khóa từ dữ liệu đầu vào
            $keywords = preg_split('/\r\n|\r|\n/', $request->input('keyword')); // Tách từ khóa vào mảng
            $keywords = array_map('trim', $keywords); // Loại bỏ khoảng trắng thừa cho từng từ khóa
    
            // Lấy danh sách từ khóa hiện tại của bài viết
            $existingKeywords = Keyword::where('article_id', $article->article_id)->pluck('keyword')->toArray();
    
            // Thêm, sửa từ khóa nếu cần
            foreach ($keywords as $keyword) {
                if (!empty($keyword)) {
                    // Kiểm tra xem từ khóa đã tồn tại trong bài viết chưa
                    $existingKeyword = Keyword::where('article_id', $article->article_id)
                                              ->where('keyword', $keyword)
                                              ->first();
            
                    if ($existingKeyword) {
                        // Nếu từ khóa đã tồn tại, cập nhật lại từ khóa (ở đây bạn có thể cập nhật lại giá trị keyword)
                        $existingKeyword->update([
                            'updated_at' => now(),  // Cập nhật thời gian sửa đổi
                        ]);
                    } else {
                        // Nếu từ khóa chưa tồn tại, tạo mới từ khóa
                        Keyword::create([ 
                            'article_id' => $article->article_id,
                            'keyword' => $keyword
                        ]);
                    }
                }
            }
    
            // Xóa các từ khóa không còn trong danh sách mới
            $keywordsToDelete = array_diff($existingKeywords, $keywords);
            foreach ($keywordsToDelete as $keyword) {
                Keyword::where('article_id', $article->article_id)
                       ->where('keyword', $keyword)
                       ->delete();
            }
        }
    
        // Trả về phản hồi thành công
        return response()->json(['status' => 200, 'message' => 'Bài viết và từ khóa đã được cập nhật thành công']);
    }
    public function update_w(Request $request, $article_id = null)
    {
        try {
            // Xác thực dữ liệu đầu vào
            $request->validate([
                'title' => 'required|string|max:255',
                'abstract' => 'nullable|string|max:250',
                'category_id' => 'required|string|max:255',
            ]);
    
            // Kiểm tra xem chuyên mục có tồn tại không
            $category = Category::where('category_id', $request->input('category_id'))->first();
            if (!$category) {
                return response()->json(['status' => 400, 'error' => 'Chuyên đề không phù hợp'], 400);
            }
    
            // Tìm bài viết theo ID
            $article = Article::find($article_id);
            if (!$article) {
                return response()->json(['status' => 404, 'error' => 'Không tìm thấy bài viết'], 404);
            }
    
            // Cập nhật bài viết
            $article->update([
                'title' => $request->input('title'),
                'abstract' => $request->input('abstract'),
                'category_id' => $category->category_id,
            ]);
    
            return response()->json(['status' => 200, 'message' => 'Bài viết đã được cập nhật thành công']);
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Lỗi xác thực
            return response()->json([
                'status' => 422,
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            // Lỗi không mong muốn
            return response()->json([
                'status' => 500,
                'error' => 'Đã xảy ra lỗi trong quá trình xử lý',
                'details' => $e->getMessage(),
            ], 500);
        }
    }
}
    