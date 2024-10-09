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
        Schema::create('phan_bien', function (Blueprint $table) {
            // $table->id('id_phan_bien');
            // $table->foreignId('id_bai_viet')->constrained('bai_viet')->onDelete('cascade');
            // $table->foreignId('id_nguoi_phan_bien')->constrained('users')->onDelete('cascade');
            $table->id('id_phan_bien');
            $table->unsignedBigInteger('id_bai_viet');
            $table->foreign('id_bai_viet')->references('id_bai_viet')->on('bai_viet')->onDelete('cascade');
            $table->unsignedBigInteger('id_nguoi_phan_bien');
            $table->date('ngay_gui');
            $table->date('ngay_chap_nhan')->nullable();
            $table->text('danh_gia');
            $table->text('yeu_cau_chinh_sua')->nullable();
            $table->text('ghi_chu')->nullable();
            $table->enum('trang_thai', ['Chờ phản biện', 'Đã phản biện', 'Từ chối'])->default('Chờ phản biện');
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('phan_bien');
    }
};
