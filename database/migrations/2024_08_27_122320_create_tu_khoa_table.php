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
        Schema::create('keywords', function (Blueprint $table) {
            $table->id('keyword_id');                  // id_tu_khoa -> keyword_id
            $table->string('keyword');                 // tu_khoa -> keyword
            $table->unsignedBigInteger('article_id');  // id_bai_viet -> article_id
            $table->foreign('article_id')->references('article_id')->on('articles')->onDelete('cascade');
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
        Schema::dropIfExists('keywords');
    }
};
