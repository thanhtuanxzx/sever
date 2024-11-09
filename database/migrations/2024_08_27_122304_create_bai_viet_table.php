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
        Schema::create('articles', function (Blueprint $table) {
            $table->id('article_id')->unsignedBigInteger();    // id_bai_viet -> article_id
            $table->string('topic')->nullable();               // chu_de -> topic
            $table->string('note')->nullable();                // ghichu -> note

            $table->string('file_name')->nullable();
            $table->string('file_path')->nullable();
            $table->string('file_mime_type')->nullable();

            $table->string('title')->nullable();               // tieu_de -> title
            $table->text('abstract')->nullable();              // tom_tat -> abstract
            $table->longText('content')->nullable();           // noi_dung -> content
            
            $table->date('submission_date')->nullable();       // ngay_gui -> submission_date
            $table->date('acceptance_date')->nullable();       // ngay_chap_nhan -> acceptance_date
            $table->enum('status', ['Pending', 'Approved', 'Rejected'])->default('Pending'); // trang_thai -> status
            $table->string('volume')->nullable();              // tap -> volume
          
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
        Schema::dropIfExists('articles');
    }
};
