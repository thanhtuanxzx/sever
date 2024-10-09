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
        Schema::create('tai_lieu_tham_khao', function (Blueprint $table) {
            $table->id('id_tai_lieu_tham_khao');
            $table->unsignedBigInteger('id_bai_viet');
            $table->foreign('id_bai_viet')->references('id_bai_viet')->on('bai_viet')->onDelete('cascade');
            $table->text('thong_tin_tai_lieu');

            
            $table->string('dinh_dang_trich_dan')->nullable();
            $table->text('trich_dan')->nullable();
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
        Schema::dropIfExists('tai_lieu_tham_khao');
    }
};
