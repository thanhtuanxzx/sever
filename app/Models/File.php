<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    // Đặt tên bảng nếu không phải theo quy ước
    protected $table = 'file';

    // Đặt các trường có thể gán đại diện cho các thuộc tính của bảng
    protected $fillable = [
        'id_bai_viet',
        'file_name',
        'file_path',
        'file_mime_type',
        'generated_name', 
    ];

    // Định nghĩa quan hệ với bảng bai_viet
    public function baiViet()
    {
        return $this->belongsTo(BaiViet::class, 'id_bai_viet');
    }
}
