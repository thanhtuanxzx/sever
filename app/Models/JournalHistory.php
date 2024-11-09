<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JournalHistory extends Model
{
    use HasFactory;

    protected $table = 'journal_history';

    protected $primaryKey = 'journal_history_id';

    protected $fillable = [
        'journal_id',
        'modification_date',
        'modification_content'
    ];

    public function journal()
    {
        return $this->belongsTo(Journal::class, 'journal_id');
    }
}
