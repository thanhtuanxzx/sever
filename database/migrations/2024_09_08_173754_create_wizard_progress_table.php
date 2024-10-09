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
        Schema::create('wizard_progress', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade'); // Nếu bạn muốn liên kết với user
            $table->unsignedBigInteger('bai_viet_id');
            $table->foreign('bai_viet_id')->references('id_bai_viet')->on('bai_viet')->onDelete('cascade');
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
