<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keyword extends Model
{
    use HasFactory;

    protected $table = 'keywords';

    protected $primaryKey = 'keyword_id';

    protected $fillable = [
        'keyword',
        'article_id'
    ];

    public function article()
    {
        return $this->belongsTo(Article::class, 'article_id');
    }
}
