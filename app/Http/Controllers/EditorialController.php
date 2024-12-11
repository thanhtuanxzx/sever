<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article; 
use App\Models\Editor;  
use App\Models\Review;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\AuthorNotifiedMail;
use App\Mail\ReviewerAssignedMail;

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
    public function getReviewer()
    {
        $users = User::where('role', '3')->get(); // Lấy danh sách người dùng với role = 3

        if ($users->isEmpty()) {
            return response()->json([
                'status' => 404,
                'message' => 'No users found',
            ]);
        }

        // Tạo danh sách reviewers
        $reviewers = $users->map(function ($user) {
            return [
                'id' => $user->id,
                'name' => $user->first_name . ' ' . $user->last_name,
                'email' => $user->email,
            ];
        });

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

}
