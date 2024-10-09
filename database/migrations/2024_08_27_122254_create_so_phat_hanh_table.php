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
        Schema::create('so_phat_hanh', function (Blueprint $table) {
            $table->id('id_so_phat_hanh');
            $table->unsignedBigInteger('id_tap_chi');
            $table->foreign('id_tap_chi')->references('id_tap_chi')->on('tap_chi')->onDelete('cascade');
            $table->string('chu_de');
            $table->string('khoa')->nullable();
            $table->string('so_phat_hanh');
            $table->string('id_ctt_sph')->nullable();
            $table->text('muc_luc')->nullable();
            $table->string('hinh_anh')->nullable();
            $table->date('ngay_phat_hanh');
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
        Schema::dropIfExists('so_phat_hanh');
    }
};
