<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\User;  
use App\Models\Article;

class CoAuthorAdded extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $article;

    /**
     * Tạo một instance mới của lớp CoAuthorAdded.
     *
     * @param User $user
     * @param Article $article
     * @return void
     */
    public function __construct(User $user, Article $article)
    {
        $this->user = $user;
        $this->article = $article;
    }

    /**
     * Xây dựng thông điệp email.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Bạn đã được thêm làm đồng tác giả')
                    ->view('emails.co_author_added')
                    ->with([
                       'userName' => $this->user->first_name . ' ' . $this->user->last_name,
                        'articleTitle' => $this->article->title,
                        'articleUrl' => url("/articles/{$this->article->article_id}"),
                    ]);
    }
}