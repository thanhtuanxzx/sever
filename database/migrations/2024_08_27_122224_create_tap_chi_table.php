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
        Schema::create('tap_chi', function (Blueprint $table) {
            $table->id('id_tap_chi')->unsigned();
            $table->string('ten_tap_chi');
            $table->string('issn')->nullable();
            $table->string('tap')->nullable();
            $table->date('ngay_phat_hanh');
            $table->date('ngay_sua_doi_gan_nhat')->nullable();
            $table->string('hinh_anh')->nullable();
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
        Schema::dropIfExists('tap_chi');
    }
};
