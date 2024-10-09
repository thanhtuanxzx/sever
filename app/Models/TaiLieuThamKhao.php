// app/Models/TaiLieuThamKhao.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaiLieuThamKhao extends Model
{
    use HasFactory;

    protected $table = 'tai_lieu_tham_khaos';

    protected $fillable = [
        'id_bai_viet', 'thong_tin_tai_lieu_tham_khao', 'dinh_dang_trich_dan', 'trich_dan'
    ];

    public function baiViet()
    {
        return $this->belongsTo(BaiViet::class, 'id_bai_viet');
    }
}
