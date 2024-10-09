<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UsersSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'id_user' => 1,
                'ho_ten' => 'Nguyen Van A',
                'email' => 'nguyenvana@example.com',
                'sdt' => '0123456789',
                'dia_chi' => '123 Street, City',
                'ngay_sinh' => '1990-01-01',
                'gioi_tinh' => 'Nam',
                'cmnd' => '123456789',
                'vai_tro' => 'Tác giả',
                'tai_khoan' => 'nguyenvana',
                'mat_khau' => Hash::make('password'),
                'hinh_anh' => 'nguyenvana.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id_user' => 2,
                'ho_ten' => 'Tran Thi B',
                'email' => 'tranthib@example.com',
                'sdt' => '0987654321',
                'dia_chi' => '456 Avenue, Town',
                'ngay_sinh' => '1985-05-12',
                'gioi_tinh' => 'Nữ',
                'cmnd' => '987654321',
                'vai_tro' => 'Phản biện',
                'tai_khoan' => 'tranthib',
                'mat_khau' => Hash::make('password123'),
                'hinh_anh' => 'tranthib.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            // Thêm nhiều bản ghi khác nếu cần
        ]);
    }
}
