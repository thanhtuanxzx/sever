<?php
namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    // Lấy tất cả thông báo của người dùng
    public function getNotifications(Request $request)
    {
        // Lấy thông báo chưa đọc của người dùng hiện tại
        $notifications = Notification::where('user_id', $request->user()->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json(['status' => 200, 'notifications' => $notifications]);
    }

    // Đánh dấu tất cả thông báo là đã đọc
    public function markAllAsRead(Request $request)
    {
        Notification::where('user_id', $request->user()->id)
            ->update(['is_read' => true]);

        return response()->json(['status' => 200, 'message' => 'Tất cả thông báo đã được đánh dấu là đã đọc']);
    }

    // Đánh dấu thông báo cụ thể là đã đọc
    public function markAsRead(Request $request, $notificationId)
    {
        $notification = Notification::find($notificationId);

        if ($notification && $notification->user_id === $request->user()->id) {
            $notification->update(['is_read' => true]);
            return response()->json(['status' => 200, 'message' => 'Thông báo đã được đánh dấu là đã đọc']);
        }

        return response()->json(['status' => 404, 'error' => 'Thông báo không tìm thấy hoặc bạn không có quyền truy cập']);
    }
}
