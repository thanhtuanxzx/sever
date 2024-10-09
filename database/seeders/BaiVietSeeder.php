<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB; 
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BaiVietSeeder extends Seeder
{
    public function run()
    {
        DB::table('bai_viet')->insert([
            [
                'tieu_de' => 'Tiêu đề bài viết 1',
                'tom_tat' => 'Tóm tắt bài viết 1',
                'noi_dung' => 'Nội dung chi tiết bài viết 1',
                'chu_de' => 'Chủ đề 1',
                'ngay_gui' => '2024-08-27',
                'trang_thai' => 'Chờ duyệt',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Thêm các bản ghi khác nếu cần
        ]);
    }
}
