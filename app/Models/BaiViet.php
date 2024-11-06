<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BaiViet extends Model
{
    use HasFactory;

    // Đặt tên bảng nếu khác với quy tắc mặc định
    protected $table = 'bai_viet';
    protected $primaryKey = 'id_bai_viet';
    // Khai báo các trường có thể được gán hàng loạt (mass assignable)
    protected $fillable = [
        'tieu_de',
        'tom_tat',
        'noi_dung',
        'chu_de',
        'ngay_gui',
        'ngay_chap_nhan',
        'trang_thai',
        'tap',
        'user_id',
        'original_name',
        'generated_name',
        'ghichu',
        'citations',
        'id_chuyen_de',
    ];

    // Nếu bạn muốn tự động quản lý các timestamp
    public $timestamps = true;
    
    // Nếu bạn không muốn dùng timestamp, đặt thành false
    // public $timestamps = false;

    // Nếu bạn cần định dạng ngày tháng đặc biệt
    protected $dates = [
        'ngay_gui',
        'ngay_chap_nhan',
    ];
    public function wizardProgress()
    {
        return $this->hasMany(WizardProgress::class, 'bai_viet_id'); // Giả sử khóa ngoại trong bảng wizard_progress là bai_viet_id
    }
    public function chuyenDe()
    {
        return $this->belongsTo(ChuyenDe::class, 'id_chuyen_de');
    }
}

