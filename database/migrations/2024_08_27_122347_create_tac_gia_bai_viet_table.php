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
   
  
        Schema::create('article_authors', function (Blueprint $table) {
            $table->id('id');                          // id
            $table->unsignedBigInteger('article_id');  // id_bai_viet -> article_id
            $table->unsignedBigInteger('author_id');   // id_tac_gia -> author_id
            $table->string('role');                    // vai_tro -> role
            $table->foreign('article_id')->references('article_id')->on('articles')->onDelete('cascade'); // bái_viet -> articles
            $table->foreign('author_id')->references('id')->on('users')->onDelete('cascade'); // tac_gia -> users
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
        Schema::dropIfExists('article_authors');
    }
};
