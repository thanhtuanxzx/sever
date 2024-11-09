<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticleAuthor extends Model
{
    use HasFactory;

    protected $table = 'article_authors';

    protected $primaryKey = 'id';

    protected $fillable = [
        'article_id',
        'author_id',
        'role'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
