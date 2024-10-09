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
        Schema::create('lich_su_tap_chi', function (Blueprint $table) {
            $table->id('id_lich_su_tap_chi');
            $table->unsignedBigInteger('id_tap_chi');
            $table->foreign('id_tap_chi')->references('id_tap_chi')->on('tap_chi')->onDelete('cascade');
            $table->date('ngay_sua_doi');
            $table->text('noi_dung_sua_doi');
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
        Schema::dropIfExists('lich_su_tap_chi');
    }
};
