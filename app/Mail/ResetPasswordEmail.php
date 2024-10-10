<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ResetPasswordEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $token; // Token để đặt lại mật khẩu

    public function __construct($token)
    {
        $this->token = $token; // Gán token vào biến
    }

    public function build()
    {
        return $this->view('emails.reset_password') // Tạo view reset_password.blade.php
            ->subject('Đặt lại mật khẩu')
            ->with(['token' => $this->token]); // Truyền token vào view
    }
}
