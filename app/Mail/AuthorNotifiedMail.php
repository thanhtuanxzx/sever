<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AuthorNotifiedMail extends Mailable
{
    use Queueable;

    protected $article;

    public function __construct($article)
    {
        $this->article = $article;
    }

    public function build()
    {
        return $this->subject('Your article has been assigned a reviewer')
                    ->view('emails.author_notified')
                    ->with([
                        'article_title' => $this->article->title,
                        'article_id' => $this->article->article_id,
                    ]);
    }
}
