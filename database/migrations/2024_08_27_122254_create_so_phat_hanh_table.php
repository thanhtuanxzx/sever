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
        Schema::create('issues', function (Blueprint $table) {
            $table->id('issue_id');                    // id_so_phat_hanh -> issue_id
            $table->unsignedBigInteger('journal_id');  // id_tap_chi -> journal_id
            $table->foreign('journal_id')->references('journal_id')->on('journals')->onDelete('cascade');
            $table->string('topic');                   // chu_de -> topic
            $table->string('department')->nullable();   // khoa -> department
            $table->string('issue_number');            // so_phat_hanh -> issue_number
            $table->string('content_id')->nullable();  // id_ctt_sph -> content_id
            $table->text('table_of_contents')->nullable(); // muc_luc -> table_of_contents
            $table->string('image')->nullable();       // hinh_anh -> image
            $table->date('publication_date');          // ngay_phat_hanh -> publication_date
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
        Schema::dropIfExists('issues');
    }
};
