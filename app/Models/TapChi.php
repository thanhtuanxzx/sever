// app/Models/TapChi.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TapChi extends Model
{
    use HasFactory;

    protected $table = 'tap_chis';

    protected $fillable = [
        'ten_tap_chi', 'ISSN', 'tap', 'ngay_phat_hanh', 'ngay_sua_doi_gan_nhat', 'hinh_anh'
    ];

    public function lichSuTapChi()
    {
        return $this->hasMany(LichSuTapChi::class, 'id_tap_chi');
    }

    public function soPhatHanh()
    {
        return $this->hasMany(SoPhatHanh::class, 'id_tap_chi');
    }
}
