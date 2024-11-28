<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article; 
use App\Models\Editor;  
use App\Models\Review;
class EditorialController extends Controller
{
    // Danh sách bài báo
    public function index()
    {
        $articles = Article::orderBy('created_at', 'desc')->paginate(10);
        return response()->json($articles);
    }

    // Chi tiết bài báo
    public function show($id)
    {
        $article = Article::findOrFail($id);
        return response()->json($article);
    }

    // Phê duyệt bài báo
    public function approve(Request $request, $id)
    {
        $article = Article::findOrFail($id);

        $article->status = $request->input('status'); // 'approved' hoặc 'rejected'
        // $article->reviewer_comment = $request->input('reviewer_comment'); // Lời nhắn
        $article->save();

        return response()->json(['message' => 'Cập nhật trạng thái bài báo thành công!']);
    }

    // Phân công phản biện 
    public function assignReviewers(Request $request)
    {
        $request->validate([
            'article_id' => 'required|integer|exists:articles,article_id',
            'reviewers' => 'required|array',
'reviewers.*' => 'integer|exists:users,id',


            'notes' => 'nullable|string',
        ]);

        $articleId = $request->input('article_id');
        $reviewerIds = $request->input('reviewers');
        $notes = $request->input('notes');

        try {
            $article = Article::where('article_id', $articleId)->first(); // Đảm bảo sử dụng đúng khóa chính
                if (!$article) {
                    return response()->json([
                        'status' => 404,
                        'error' => 'Không tìm thấy bài viết.',
                    ], 404);
                }

         
            foreach ($reviewerIds as $reviewerId) {
                Review::create([
                    'article_id' => $articleId,
                    'reviewer_id' => $reviewerId,
                    'status' => 'pending', // Mặc định trạng thái là chờ phản biện
                    'notes' => $notes,
                ]);
            }

            // Cập nhật trạng thái bài viết (tuỳ chỉnh nếu cần)
            $article->update(['status' => 'assigned']);

            return response()->json([
                'status' => 200,
                'message' => 'Phân công phản biện thành công!',
            ]);
        } catch (\Exception $e) {
            Log::error('Lỗi phân công phản biện: ' . $e->getMessage());

            return response()->json([
                'status' => 500,
                'error' => 'Đã xảy ra lỗi trong quá trình phân công.',
            ], 500);
        }
    }

    // Thống kê
    public function statistics()
    {
        $stats = [
            'total' => Article::count(),
            'approved' => Article::where('status', 'approved')->count(),
            'pending' => Article::where('status', 'pending')->count(),
            'rejected' => Article::where('status', 'rejected')->count(),
        ];

        return response()->json($stats);
    }
}
