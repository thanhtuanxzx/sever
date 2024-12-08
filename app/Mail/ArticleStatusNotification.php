<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Article;

class ArticleStatusNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $article;
    public $decision;
    public $comment;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Article $article, $decision, $comment = null)
    {
        $this->article = $article;
        $this->decision = $decision;
        $this->comment = $comment;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = match ($this->decision) {
            'Send_to_editor' => 'Bài viết được chuyển đến Ban Biên Tập',
            'Rejected' => 'Bài viết bị từ chối',
            'Not_approved' => 'Bài viết không được duyệt',
            default => 'Thông báo về bài viết',
        };

        return $this->view('emails.article_status')
                    ->subject($subject)
                    ->with([
                        'article' => $this->article,
                        'decision' => $this->decision,
                        'comment' => $this->comment,
                    ]);
    }
}
