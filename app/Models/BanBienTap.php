<?php
// app/Models/BanBienTap.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BanBienTap extends Model
{
    use HasFactory;

    protected $table = 'ban_bien_taps';

    protected $fillable = [
        'hoten', 'ngaysinh', 'diachi', 'email', 'gioitinh', 'sdt', 
        'cmnd', 'congviec', 'chucvu', 'cosocongtac', 'truongdaihoc',
        'khoa', 'bomonutructhuoc', 'hinhanh'
    ];

    public function lichSuTapChi()
    {
        return $this->hasMany(LichSuTapChi::class, 'id_bien_tap');
    }
}
