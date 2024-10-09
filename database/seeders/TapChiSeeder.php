<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class TapChiSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tap_chi')->insert([
            [
                'ten_tap_chi' => 'Tập chí Khoa học 1',
                'issn' => '1234-5678',
                'tap' => 1,
                'ngay_phat_hanh' => '2024-01-01',
                'ngay_sua_doi_gan_nhat' => Carbon::now(),
                'hinh_anh' => 'tap_chi_1.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'ten_tap_chi' => 'Tập chí Khoa học 2',
                'issn' => '2345-6789',
                'tap' => 2,
                'ngay_phat_hanh' => '2024-02-01',
                'ngay_sua_doi_gan_nhat' => Carbon::now(),
                'hinh_anh' => 'tap_chi_2.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            // Thêm nhiều bản ghi khác nếu cần
        ]);
    }
}
