<?php

namespace App\Models;
use Laravel\Sanctum\HasApiTokens;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    use HasFactory, HasApiTokens,Notifiable;
   

    // Các thuộc tính có thể được gán hàng loạt
    protected $fillable = [
        'first_name',
        'last_name',
        'organization',
        'phone',
        'nationality',
        'email',
        'username',
        'password',
      
        'status',
        'token',
        'chucdanh',
        'gioitinh',
        'quyen',
        'tieusu',
        'linkurl',
        'avatar',
        'file_name',       
        'file_path',       
        'file_mime_type', 
        'avatar_original_name',
        'avatar_mime_type',
        'avatar_size',
        'linhvucnc' 
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

    // Phương thức để lấy đường dẫn đầy đủ của file
    public function getFileUrlAttribute()
    {
        return $this->file_path ? Storage::url($this->file_path) : null;
    }

    // Phương thức để cập nhật file
    public function updateFile($file)
    {
        // Xóa file cũ nếu tồn tại
        if ($this->file_path) {
            Storage::delete($this->file_path);
        }

        // Lưu file mới và cập nhật các thuộc tính liên quan
        $filePath = $file->store('user_files');
        $this->file_name = $file->getClientOriginalName();
        $this->file_path = $filePath;
        $this->file_mime_type = $file->getClientMimeType();
        $this->save();
    }
}
