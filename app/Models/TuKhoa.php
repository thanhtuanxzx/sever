<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TuKhoa extends Model
{
    protected $table = 'tu_khoa';
    protected $fillable = ['id_bai_viet', 'tu_khoa'];

    public function baiViet()
    {
        return $this->belongsTo(BaiViet::class, 'bai_viet_id');
    }
}
