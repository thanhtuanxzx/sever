<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('profile_image')->nullable()->after('email'); // Cột hình ảnh đại diện
            $table->text('bio')->nullable()->after('profile_image'); // Cột tiểu sử
            $table->string('homepage_url')->nullable()->after('bio'); // Cột trang chủ URL
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['profile_image', 'bio', 'homepage_url']);
        });
    }
};
