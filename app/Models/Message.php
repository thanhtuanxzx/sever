<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $table = 'messages';

    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id',
        'message',
        'editable_until',
        'role',
        'room_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function canEdit()
    {
        $currentTime = now();
        $messageCreatedAt = $this->created_at;

        // Kiểm tra quyền chỉnh sửa: chỉ cho phép nếu người dùng là chủ sở hữu tin nhắn 
        // và thời gian tạo tin nhắn chưa quá 2 tiếng
        // return $this->user_id === auth()->id() && $messageCreatedAt->diffInHours($currentTime) < 2;// 2 tiếng 
        return $this->user_id === auth()->id() && $messageCreatedAt->diffInSeconds($currentTime) < 10;//10 giây 
    }
}
