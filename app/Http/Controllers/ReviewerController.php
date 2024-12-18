<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ReviewerController extends Controller
{
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

}
