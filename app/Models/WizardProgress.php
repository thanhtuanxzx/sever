<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WizardProgress extends Model
{
    protected $fillable = [
        'user_id',
        'bai_viet_id',
        'current_step',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function baiViet()
    {
        return $this->belongsTo(BaiViet::class, 'bai_viet_id');
    }
    
}
