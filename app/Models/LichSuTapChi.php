<?php
// app/Models/LichSuTapChi.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LichSuTapChi extends Model
{
    use HasFactory;

    protected $table = 'lichsutapchis';

    protected $fillable = [
        'id_tap_chi', 'ngay_sua_doi', 'noi_dung_sua_doi', 'id_bien_tap'
    ];

    public function tapChi()
    {
        return $this->belongsTo(TapChi::class, 'id_tap_chi');
    }

    public function bienTap()
    {
        return $this->belongsTo(BanBienTap::class, 'id_bien_tap');
    }
}
