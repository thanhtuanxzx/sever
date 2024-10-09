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
        Schema::create('bai_viet', function (Blueprint $table) {
            $table->id('id_bai_viet')->unsignedBigInteger();
            $table->string('chu_de')->nullable();
            $table->string('ghichu')->nullable();

            $table->string('file_name')->nullable();
            $table->string('file_path')->nullable();
            $table->string('file_mime_type')->nullable();

            $table->string('tieu_de')->nullable();
            $table->text('tom_tat')->nullable();
            $table->longText('noi_dung')->nullable();
            
            $table->date('ngay_gui')->nullable();
            $table->date('ngay_chap_nhan')->nullable();
            $table->enum('trang_thai', ['Chờ duyệt', 'Đã duyệt', 'Từ chối'])->default('Chờ duyệt');
            $table->string('tap')->nullable();
          
            
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
        Schema::dropIfExists('bai_viet');
    }
};
