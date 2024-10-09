// app/Models/TacGia.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TacGia extends Model
{
    use HasFactory;

    protected $table = 'tac_gias';

    protected $fillable = [
        'ho_va_ten', 'ten_dem', 'co_quan', 'dien_thoai', 'quoc_tich', 
        'email', 'tai_khoan', 'mat_khau', 'vai_tro_phan_bien'
    ];

    public function baiViets()
    {
        return $this->belongsToMany(BaiViet::class, 'tac_gia_bai_viets', 'id_tac_gia', 'id_bai_viet')
                    ->withPivot('vai_tro');
    }

    public function phanBiens()
    {
        return $this->hasMany(PhanBien::class, 'id_nguoi_phan_bien');
    }
}
