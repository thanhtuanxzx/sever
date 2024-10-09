// app/Models/SoPhatHanh.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SoPhatHanh extends Model
{
    use HasFactory;

    protected $table = 'so_phat_hanhs';

    protected $fillable = [
        'id_tap_chi', 'chu_de', 'khoa', 'so_phat_hanh', 'id_cttsph', 
        'muc_luc', 'hinh_anh', 'ngay_phat_hanh'
    ];

    public function tapChi()
    {
        return $this->belongsTo(TapChi::class, 'id_tap_chi');
    }

    public function baiViet()
    {
        return $this->hasMany(BaiViet::class, 'id_so_phat_hanh');
    }
}
