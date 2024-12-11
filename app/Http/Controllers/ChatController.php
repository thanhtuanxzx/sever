<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Message;
use App\Events\NewMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Article;
use Illuminate\Support\Str;
use App\Models\File;
class ChatController extends Controller
{
    public function sendMessage(Request $request)
{
    $request->validate([
        'article_id' => 'required|integer',
        'message' => 'required|string',
    ]);

    // Lấy thông tin người dùng đã đăng nhập
    $user = auth()->user();

    try {
        $article_ = Article::where('article_id', $request->article_id)->first();
        if (!$article_) {
            return response()->json([
                'error' => 'Không tồn tại khung chat.',
                'status' => '400',
            ], 400);
        }
        // Kiểm tra nếu người gửi có vai trò là tác giả (role = 4)
        if ($user->role == 4) {
            // Kiểm tra xem bài viết có thuộc về người dùng (tác giả)
            $article = Article::where('user_id', $user->id)->first();
               

            if (!$article) {
                return response()->json([
                    'error' => 'Bạn không phải là tác giả của bài viết.',
                    'status' => '400',
                ], 400);
            }
           
        }

        // Lưu tin nhắn
        $message = Message::create([
            'room_id' => $request->article_id,
            'user_id' => $user->id,
            'role' => $user->role,
            'message' => $request->message,
        ]);

        // Phát sự kiện
        event(new NewMessage($message));

        return response()->json(['message' => $message, 'status' => '200']);
    } catch (\Illuminate\Database\QueryException $e) {
        // Xử lý lỗi từ cơ sở dữ liệu
        return response()->json([
            'error' => 'Lỗi cơ sở dữ liệu: ' . $e->getMessage(),
            'status' => '500',
        ], 500);
    } catch (\Exception $e) {
        // Xử lý lỗi chung
        return response()->json([
            'error' => 'Đã xảy ra lỗi: ' . $e->getMessage(),
            'status' => '500',
        ], 500);
    }
}

public function getMessages(Request $request)
    {
        $request->validate([
            'room_id' => 'required|integer',
        ]);

        $user = auth()->user();

        // Nếu người dùng có role = 4, kiểm tra quyền truy cập
        if ($user->role == 4) {
            $isParticipant = Message::where('room_id', $request->room_id)
                ->where('user_id', $user->id)
                ->exists();

            if (!$isParticipant) {
                return response()->json([
                    'error' => 'Bạn không có quyền truy cập phòng chat này.',
                    'status' => '403',
                ], 403);
            }
        }

        // Lấy tin nhắn thuộc cùng room_id, sắp xếp theo thứ tự trước sau
        $messages = Message::where('room_id', $request->room_id)
            ->orderBy('created_at', 'asc')
            ->with('user') // Lấy thông tin người dùng gửi tin nhắn
            ->get();

        return response()->json([
            'messages' => $messages,
            'status' => '200',
        ]);
    }


    // public function getMessages()
    // {
    //     // Lấy tất cả tin nhắn
    //     // $messages = Message::with('user')->latest()->get();     Kèm thông tin users
    //     $messages = Message::latest()->get();
    //     return response()->json($messages);
    // }

    // public function getMessages() // Lấy tin nhắn thuộc 1 user
    // {   
    //     $user = auth()->user();
      
    //     // $messages = Message::with('user')->latest()->get();     Kèm thông tin users
    //     $messages = Message::where('user_id',$user->id)->get();
    //     return response()->json($messages);
    // }

    public function updateMessage(Request $request, $id)
    {
        $request->validate([
            'message' => 'required|string',
        ]);

        $message = Message::find($id);

        if (!$message) {
            return response()->json(['message' => 'Message not found'], 404);
        }

        // Kiểm tra xem người dùng có quyền chỉnh sửa tin nhắn này hay không
        if ($message->user_id !== auth()->id() || !$message->canEdit()) {
            return response()->json(['message' => 'Cannot edit this message'], 403);
        }

        // Cập nhật tin nhắn
        $message->update([
            'message' => $request->message,
        ]);

        return response()->json(['message' => 'Message updated successfully']);
    }

    public function deleteMessage($id)
    {
        $message = Message::find($id);

        if (!$message) {
            return response()->json(['message' => 'Message not found'], 404);
        }

        // Kiểm tra xem người dùng có quyền thu hồi tin nhắn này hay không
        if ($message->user_id !== auth()->id() || !$message->canEdit()) {
            return response()->json(['message' => 'Cannot delete this message'], 403);
        }

        // Xóa (thu hồi) tin nhắn
        $message->delete();

        return response()->json(['message' => 'Message deleted successfully']);
    }
    public function getfile(Request $request)
    {
        // Xác thực dữ liệu đầu vào
        $request->validate([
            'file.*' => 'file|max:2048', // Cho phép nhiều file
            'article_id' => 'required|exists:articles,article_id',
            'comment'=>'string' 
        ]);
    
        $articleId = $request->input('article_id'); // Lấy article_id từ yêu cầu
    
        // Kiểm tra xem có tệp tin nào được tải lên không
        if ($request->hasFile('file')) {
            $files = $request->file('file');
    
            // Nếu chỉ có một tệp, chuyển nó thành mảng để xử lý nhất quán
            if (!is_array($files)) {
                $files = [$files];
            }
    
            foreach ($files as $file) {
                // Tạo tên tệp ngẫu nhiên
                $generatedFileName = Str::random(20) . '.' . $file->getClientOriginalExtension();
                // Lưu tệp vào thư mục 'uploads'
                $filePath = $file->storeAs('uploads', $generatedFileName, 'public');
    
                // Lưu thông tin tệp vào cơ sở dữ liệu
                File::create([
                    'article_id' => $articleId,
                    'generated_name' => $generatedFileName,
                    'file_name' => $file->getClientOriginalName(),
                    'file_path' => $filePath,
                    'file_mime_type' => $file->getMimeType(),
                    'comment' => $request->input('comment'),
                ]);
            }
    
            return response()->json([
                'status' => 200,
                'message' => 'Các tệp đã được tải lên thành công và bài viết đã được cập nhật.'
            ]);
        } else {
            return response()->json([
                'status' => 400,
                'message' => 'Không có tệp nào được tải lên.'
            ]);
        }
    }
    

}