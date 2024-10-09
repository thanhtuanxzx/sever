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
        Schema::create('tac_gia_bai_viet', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_bai_viet');  // Đảm bảo kiểu dữ liệu khớp với cột trong bảng 'bai_viet'
            $table->unsignedBigInteger('id_tac_gia');
            $table->string('vai_tro');
            $table->foreign('id_bai_viet')->references('id_bai_viet')->on('bai_viet')->onDelete('cascade');
            $table->foreign('id_tac_gia')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('tac_gia_bai_viet');
    }
};
