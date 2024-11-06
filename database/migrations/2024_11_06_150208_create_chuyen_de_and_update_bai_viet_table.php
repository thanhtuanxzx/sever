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
        Schema::create('chuyen_de', function (Blueprint $table) {
            $table->id('id_chuyen_de')->unsignedBigInteger();
            $table->string('ten_chuyen_de')->nullable();
            $table->text('mo_ta')->nullable();
            $table->timestamps();
        });

        // Cập nhật bảng bài viết để thêm khóa ngoại liên kết với bảng chuyên đề
        Schema::table('bai_viet', function (Blueprint $table) {
            // Thêm cột id_chuyen_de để lưu khóa ngoại
            $table->unsignedBigInteger('id_chuyen_de')->nullable();

            // Thiết lập khóa ngoại từ bai_viet đến chuyen_de
            $table->foreign('id_chuyen_de')->references('id_chuyen_de')->on('chuyen_de')
                  ->onDelete('set null'); // Khi chuyên đề bị xóa, cột id_chuyen_de sẽ là null
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bai_viet', function (Blueprint $table) {
            $table->dropForeign(['id_chuyen_de']);
            $table->dropColumn('id_chuyen_de');
        });

        // Xóa bảng chuyên đề
        Schema::dropIfExists('chuyen_de');
    }
};
