<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Journal extends Model
{
    use HasFactory;

    protected $table = 'journals';

    protected $primaryKey = 'journal_id';

    protected $fillable = [
        'journal_name',
        'issn',
        'volume',
        'publication_date',
        'last_modified_date',
        'image'
    ];

    public function issues()
    {
        return $this->hasMany(Issue::class, 'journal_id');
    }
}
