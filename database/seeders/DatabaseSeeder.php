<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB; 
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UsersSeeder::class,
            BaiVietSeeder::class,
            PhanBienSeeder::class,
            TapChiSeeder::class,
            // Thêm các seeder khác nếu có
        ]);
    }
}
