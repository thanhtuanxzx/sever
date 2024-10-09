// app/Models/TrichDan.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrichDan extends Model
{
    use HasFactory;

    protected $table = 'trich_dans';

    protected $fillable = [
        'id_bai_viet', 'dinh_dang_trich_dan', 'noi_dung_trich_dan'
    ];

    public function baiViet()
    {
        return $this->belongsTo(BaiViet::class, 'id_bai_viet');
    }
}
