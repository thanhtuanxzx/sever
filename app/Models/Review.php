<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table = 'reviews';
    protected $fillable = [
        'article_id',
        'reviewer_id',
        'submission_date',
        'acceptance_date',
        'evaluation',
        'revision_requirements',
        'notes',
        'status',
    ];
    public function article()
    {
        return $this->belongsTo(Article::class, 'article_id');
    }
    public function reviewer()
{
    return $this->belongsTo(User::class, 'reviewer_id');
}

}
