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
        Schema::create('journal_history', function (Blueprint $table) {
            $table->id('journal_history_id');          // id_lich_su_tap_chi -> journal_history_id
            $table->unsignedBigInteger('journal_id');  // id_tap_chi -> journal_id
            $table->foreign('journal_id')->references('journal_id')->on('journals')->onDelete('cascade');
            $table->date('modification_date');         // ngay_sua_doi -> modification_date
            $table->text('modification_content');      // noi_dung_sua_doi -> modification_content
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
        Schema::dropIfExists('journal_history');
    }
};
