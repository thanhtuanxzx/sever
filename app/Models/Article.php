<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
        'chu_de', 'ghichu', 'tieu_de', 'tom_tat', 'tu_khoa',
    ];
}