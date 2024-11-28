<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $table = 'articles';

    protected $primaryKey = 'article_id';

    protected $fillable = [
        'user_id',
        'topic',
        'note',
        'title',
        'abstract',
        'content',
        'submission_date',
        'acceptance_date',
        'status',
        'volume',
        'original_name',
        'generated_name',
        'citations',
        'category_id'
    ];

    public function authors()
    {
        return $this->belongsToMany(User::class, 'article_authors', 'article_id', 'author_id')
                    ->withPivot('role')
                    ->withTimestamps();
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function citations()
    {
        return $this->hasMany(Citation::class, 'article_id');
    }

    public function files()
    {
        return $this->hasMany(File::class, 'article_id');
    }

    public function keywords()
    {
        return $this->hasMany(Keyword::class, 'article_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function submissionProgress()
    {
        return $this->hasMany(SubmissionProgress::class, 'article_id'); // Đảm bảo khóa ngoại chính xác
    }
    public function reviews()
    {
        return $this->hasMany(Review::class, 'article_id');
    }
}
