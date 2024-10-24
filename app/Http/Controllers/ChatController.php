<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Message;
use App\Events\NewMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function sendMessage(Request $request)
    {
        $request->validate([
            'message' => 'required|string',
        ]);

        // Lấy thông tin người dùng đã đăng nhập
        $user = auth()->user();

        // Lưu tin nhắn
        $message = Message::create([
            'user_id' => $user->id,
            'message' => $request->message,
        ]);

        // Phát sự kiện
        event(new NewMessage($message));

        return response()->json(['message' => $message, 'status' => 'Message sent!']);
    }

    public function getMessages()
    {
        // Lấy tất cả tin nhắn
        // $messages = Message::with('user')->latest()->get();     Kèm thông tin users
        $messages = Message::latest()->get();
        return response()->json($messages);
    }
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


}