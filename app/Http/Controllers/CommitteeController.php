<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\ArticleStatusNotification; 

class CommitteeController extends Controller
{
     /**
     * Lấy danh sách các bài viết đang chờ Ban Trị Sự xem xét.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getPendingArticles()
    {
        // Lấy các bài viết có trạng thái đang chờ xử lý bởi Ban Trị Sự
        $articles = Article::where('status', 'Pending_committee')->get();

        return response()->json([
            'status' => 200,
            'data' => $articles,
        ]);
    }

    /**
     * Ban Trị Sự đánh giá bài viết.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $article_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function reviewArticle(Request $request, $article_id)
    {
        // Lấy thông tin bài viết
        $article = Article::find($article_id);

        if (!$article) {
            return response()->json([
                'status' => 404,
                'error' => 'Bài viết không tồn tại',
            ], 404);
        }

        // Kiểm tra trạng thái bài viết
        if ($article->status !== 'Pending_committee') {
            return response()->json([
                'status' => 400,
                'error' => 'Bài viết này không ở trạng thái chờ xử lý bởi Ban Trị Sự',
            ], 400);
        }

        // Validate yêu cầu từ phía client
        $request->validate([
            'decision' => 'required|in:Send_to_editor,Rejected,Not_approved',
            'comment' => 'nullable|string|max:500',
        ]);

        $statusMessage = '';

        // Thực hiện cập nhật trạng thái bài viết
        switch ($request->input('decision')) {
            case 'Send_to_editor':
                $article->status = 'Pending_editor'; // Trạng thái tiếp tục gửi cấp tiếp theo
                $statusMessage = 'Bài viết đã được gửi đến Ban Biên Tập.';
                break;

            case 'Rejected':
                $article->status = 'Committee_rejected'; // Trạng thái từ chối (Cho phép tác giả cập nhật)
                $statusMessage = 'Bài viết của bạn đã bị từ chối. Vui lòng cập nhật để gửi lại.';
                break;

            case 'Not_approved':
                $article->status = 'Not_approved'; // Trạng thái từ chối hoàn toàn (Không cho phép tác giả cập nhật)
                $statusMessage = 'Bài viết của bạn đã không được duyệt.';
                break;
        }

        // Lưu trạng thái mới
        $article->save();

        // Gửi email thông báo
        Mail::to($article->user->email)->send(new ArticleStatusNotification($article, $request->input('decision'), $request->input('comment')));

        return response()->json([
            'status' => 200,
            'message' => 'Đánh giá bài viết thành công. ' . $statusMessage,
        ]);
    }
}
