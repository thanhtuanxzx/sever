<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $table = 'file';

    protected $primaryKey = 'file_id';

    protected $fillable = [
        'article_id',
        'file_name',
        'file_path',
        'file_mime_type',
        'generated_name',
        'comment'
    ];

    public function article()
    {
        return $this->belongsTo(Article::class, 'article_id');
    }
}
