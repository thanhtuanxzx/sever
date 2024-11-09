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
        Schema::create('journals', function (Blueprint $table) {
            $table->id('journal_id')->unsigned();         // id_tap_chi -> journal_id
            $table->string('journal_name');               // ten_tap_chi -> journal_name
            $table->string('issn')->nullable();
            $table->string('volume')->nullable();         // tap -> volume
            $table->date('publication_date');             // ngay_phat_hanh -> publication_date
            $table->date('last_modified_date')->nullable(); // ngay_sua_doi_gan_nhat -> last_modified_date
            $table->string('image')->nullable();          // hinh_anh -> image
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
        Schema::dropIfExists('journals');
    }
};
