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
        Schema::create('references', function (Blueprint $table) {
            $table->id('reference_id');                // id_tai_lieu_tham_khao -> reference_id
            $table->unsignedBigInteger('article_id');  // id_bai_viet -> article_id
            $table->foreign('article_id')->references('article_id')->on('articles')->onDelete('cascade');
            $table->text('reference_info');            // thong_tin_tai_lieu -> reference_info

            $table->string('citation_format')->nullable(); // dinh_dang_trich_dan -> citation_format
            $table->text('citation')->nullable();      // trich_dan -> citation
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
        Schema::dropIfExists('references');
    }
};
