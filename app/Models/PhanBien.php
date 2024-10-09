// app/Models/PhanBien.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhanBien extends Model
{
    use HasFactory;

    protected $table = 'phan_biens';

    protected $fillable = [
        'id_bai_viet', 
        'id_nguoi_phan_bien', 
        'ngay_gui', 
        'ngay_chap_nhan',
        'danh_gia', 
        'yeu_cau_chinh_sua', 
        'ghi_chu', 
        'trang_thai'
    ];

    public function baiViet()
    {
        return $this->belongsTo(BaiViet::class, 'id_bai_viet');
    }

    public function nguoiPhanBien()
    {
        return $this->belongsTo(TacGia::class, 'id_nguoi_phan_bien');
    }
}
