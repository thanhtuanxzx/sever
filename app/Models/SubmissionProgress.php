<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubmissionProgress extends Model
{
    use HasFactory;

    protected $table = 'submission_progress';

    // Các cột có thể gán
    protected $fillable = [
        'user_id',
        'article_id',
        'current_step',
    ];

    // Định nghĩa quan hệ với bảng User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Định nghĩa quan hệ với bảng Article
    public function article()
    {
        return $this->belongsTo(Article::class);
    }
}
