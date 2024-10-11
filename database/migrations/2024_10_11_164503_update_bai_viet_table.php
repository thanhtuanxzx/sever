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
        Schema::table('bai_viet', function (Blueprint $table) {
            // Xóa các cột không cần thiết
            $table->dropColumn(['file_name', 'file_path', 'file_mime_type']);

            // Thêm các cột mới
            $table->string('original_name')->nullable();  // Cột original_name
            $table->string('generated_name')->nullable(); // Cột generated_name
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bai_viet', function (Blueprint $table) {
            // Thêm lại các cột đã xóa
            $table->string('file_name')->nullable();  
            $table->string('file_path')->nullable();  
            $table->string('file_mime_type')->nullable();

            // Xóa các cột mới
            $table->dropColumn('original_name');  
            $table->dropColumn('generated_name'); 
        });
    }
};
