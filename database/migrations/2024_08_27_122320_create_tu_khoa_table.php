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
        Schema::create('tu_khoa', function (Blueprint $table) {
            $table->id('id_tu_khoa');
            $table->string('tu_khoa');
            $table->unsignedBigInteger('id_bai_viet');
            $table->foreign('id_bai_viet')->references('id_bai_viet')->on('bai_viet')->onDelete('cascade');
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
        Schema::dropIfExists('tu_khoa');
    }
};
