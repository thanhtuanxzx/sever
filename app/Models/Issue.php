<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Issue extends Model
{
    use HasFactory;

    protected $table = 'issues';

    protected $primaryKey = 'issue_id';

    protected $fillable = [
        'journal_id',
        'topic',
        'department',
        'issue_number',
        'content_id',
        'table_of_contents',
        'image',
        'publication_date'
    ];

    public function journal()
    {
        return $this->belongsTo(Journal::class, 'journal_id');
    }
}
