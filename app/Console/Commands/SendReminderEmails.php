<?php

namespace App\Console\Commands;
use Illuminate\Support\Facades\Mail;
use Illuminate\Console\Command;
use App\Models\Review;
use App\Models\Article;
use App\Models\User;
class SendReminderEmails extends Command
{
    protected $signature = 'reminder:send';
    protected $description = 'Send reminder email 1 day before the submission deadline';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Lấy các bài viết có ngày nộp là ngày mai
        $reviews = Review::whereDate('submission_date', '=', now()->addDay()->toDateString())
            ->where('status', 'Pending review')
            ->get();

        // Gửi email cho các reviewer
        // foreach ($reviews as $review) {
        //     $reviewer = $review->reviewer; // Giả sử bạn có mối quan hệ 'reviewer' trong model Review
        //     Mail::to($reviewer->email)->send(new \App\Mail\ReminderEmail($review));
        // }

        foreach ($reviews as $review) {
            // Lấy thông tin bài viết từ article_id
            $article = Article::find($review->article_id);
    
            if ($article) {
                // Lấy người dùng (user) từ user_id trong bảng articles
                $user = User::find($article->user_id);
    
                if ($user) {
                    // Gửi email cho người dùng
                    Mail::to($user->email)->send(new \App\Mail\ReminderEmail($review));
                }
            }
        }
        $this->info('Reminder emails sent successfully!');
    }
}