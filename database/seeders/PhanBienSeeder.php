<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PhanBienSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('phan_bien')->insert([
            [
                'id_bai_viet' => 1, // ID của bài viết liên quan
                'id_nguoi_phan_bien' => 1, // ID của người phản biện
                'ngay_gui' => '2024-08-01',
                'ngay_chap_nhan' => '2024-08-05',
                'danh_gia' => 'Tốt',
                'yeu_cau_chinh_sua' => 'Cần chỉnh sửa một số điểm nhỏ',
                'ghi_chu' => 'Phản biện rất chi tiết và hữu ích',
                'trang_thai' => 'Chờ phản biện',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            
            // Thêm nhiều bản ghi khác nếu cần
        ]);
    }
}
