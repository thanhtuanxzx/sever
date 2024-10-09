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
            // Thêm các cột mới vào bảng users
            $table->string('chucdanh')->nullable()->after('token');        // Chức danh
            $table->string('gioitinh')->nullable()->after('chucdanh');     // Giới tính
            $table->string('quyen')->nullable()->after('gioitinh');        // Quyền
            $table->text('tieusu')->nullable()->after('quyen');            // Tiểu sử
            $table->string('linkurl')->nullable()->after('tieusu');        // Link URL
            $table->string('avatar')->nullable()->after('linkurl');        // Avatar (URL hoặc tên file)

            // Thêm các cột liên quan đến file (avatar)
            $table->string('file_name')->nullable()->after('avatar');   // Tên file avatar
            $table->string('file_path')->nullable()->after('file_name'); // Đường dẫn file
            $table->string('file_mime_type')->nullable()->after('file_path');  // Loại MIME của file
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
            // Xóa các cột khi rollback migration
            $table->dropColumn('chucdanh');
            $table->dropColumn('gioitinh');
            $table->dropColumn('quyen');
            $table->dropColumn('tieusu');
            $table->dropColumn('linkurl');
            $table->dropColumn('avatar');
            $table->dropColumn('file_name');
            $table->dropColumn('file_path');
            $table->dropColumn('file_mime_type');
        });
    }
};
