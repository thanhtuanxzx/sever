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
        Schema::create('file', function (Blueprint $table) {
            $table->id('id_file'); // Khóa chính của bảng file
            $table->unsignedBigInteger('id_bai_viet'); // Khóa ngoại liên kết với bảng bai_viet
            $table->string('file_name')->nullable();
            $table->string('file_path')->nullable();
            $table->string('file_mime_type')->nullable();
            $table->timestamps();

            // Định nghĩa khóa ngoại
            $table->foreign('id_bai_viet')->references('id_bai_viet')->on('bai_viet')->onDelete('cascade');
        });
        

        
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('files');
    }
};
