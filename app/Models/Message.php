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
        'editable_until'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
