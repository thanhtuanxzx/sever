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
   
        Schema::create('submission_progress', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade'); // Liên kết với người dùng
            $table->unsignedBigInteger('article_id'); // bai_viet_id -> article_id
            $table->foreign('article_id')->references('article_id')->on('articles')->onDelete('cascade'); // bái_viet -> articles
            $table->integer('current_step')->default(1); // Lưu trữ bước hiện tại
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
        Schema::dropIfExists('wizard_progress');
    }
};
