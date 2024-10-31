<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, HasApiTokens, Notifiable;

    // Các thuộc tính có thể được gán hàng loạt
    protected $fillable = [
        'first_name',
        'last_name',
        'organization',
        'phone',
        'nationality',
        'email',
        'bio',
        'homepage_url',
        'username',
        'status',
        'token',
        'chucdanh',
        'gioitinh',
        'quyen',
        'tieusu',
        'linkurl',
        'avatar',
        'linhvucnc',
        'password', // Đừng quên thêm password vào fillable
    ];

    // Các thuộc tính bị ẩn khi trả về dữ liệu người dùng
    protected $hidden = [
        'password',
    ];

    // Các thuộc tính cần chuyển kiểu dữ liệu
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Định nghĩa mối quan hệ hasOne với TacGiaBaiViet
    public function tacGiaBaiViet()
    {
        return $this->hasOne(TacGiaBaiViet::class, 'id_bai_viet');
    }

    // Phương thức để trả về định danh người dùng
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    // Phương thức để trả về các claims tùy chỉnh
    public function getJWTCustomClaims()
    {
        return [];
    }
}
