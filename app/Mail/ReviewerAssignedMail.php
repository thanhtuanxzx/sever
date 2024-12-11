<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ReviewerAssignedMail extends Mailable
{
    use Queueable;

    protected $review;

    public function __construct($review)
    {
        $this->review = $review;
    }

    public function build()
    {
        return $this->subject('You have been assigned as a reviewer')
                    ->view('emails.reviewer_assigned')
                    ->with([
                        'article_id' => $this->review->article_id,
                        'reviewer_id' => $this->review->reviewer_id,
                        // 'status' => $this->review->status,
                    ]);
    }
}