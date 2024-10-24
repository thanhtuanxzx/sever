<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',  
        'message',  
        'editable_until',
    ];
    protected $dates = ['editable_until'];

    protected static function boot()
    {
        parent::boot();

        // Đặt thời gian chỉnh sửa là 1 giờ sau khi tạo tin nhắn
        static::creating(function ($message) {
            $message->editable_until = Carbon::now()->addHour();
        });
    }

    // Kiểm tra xem tin nhắn có thể chỉnh sửa hoặc thu hồi hay không
    public function canEdit()
    {
        return $this->editable_until && $this->editable_until->isFuture();
    }
    // Quan hệ với bảng User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
