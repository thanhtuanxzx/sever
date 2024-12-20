<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Citation extends Model
{
    use HasFactory;

    protected $table = 'citations';

    protected $primaryKey = 'id';

    protected $fillable = [
        'title',
        'link',
        'article_id'
    ];

    public function article()
    {
        return $this->belongsTo(Article::class, 'article_id');
    }
}
