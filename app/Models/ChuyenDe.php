<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChuyenDe extends Model
{
    use HasFactory;

    protected $table = 'chuyen_de';  // Đảm bảo tên bảng chính xác nếu cần

    protected $primaryKey = 'id_chuyen_de';  // Đảm bảo khóa chính đúng

    protected $fillable = ['ten_chuyen_de', 'mo_ta'];  // Các trường có thể điền

    // Mối quan hệ 1-N với BaiViet
    public function baiViets()
    {
        return $this->hasMany(BaiViet::class, 'id_chuyen_de');
    }
}
