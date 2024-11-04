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
        Schema::table('file', function (Blueprint $table) {
            // Thêm cột generated_name
            $table->string('generated_name')->nullable(); // Có thể sử dụng 'default' hoặc 'unique' nếu cần
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('file', function (Blueprint $table) {
            // Xóa cột generated_name nếu rollback
            $table->dropColumn('generated_name');
        });
    }
};
