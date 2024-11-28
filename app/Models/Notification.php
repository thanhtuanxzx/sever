<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'title', 'message', 'url', 'is_read'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public $timestamps = false;
}
