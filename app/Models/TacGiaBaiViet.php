<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TacGiaBaiViet extends Model
{
    use HasFactory;

    protected $table = 'tac_gia_bai_viet';

    protected $fillable = [
        'id_bai_viet', 'id_tac_gia', 'vai_tro'
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'id_tac_gia'); // 'id_tac_gia' là khóa ngoại trong bảng tac_gia_bai_viet
    }
}
