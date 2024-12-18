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
        Schema::create('reviews', function (Blueprint $table) {
         
            $table->id('review_id');                    // id_phan_bien -> review_id
            $table->unsignedBigInteger('article_id');   // id_bai_viet -> article_id
            $table->foreign('article_id')->references('article_id')->on('articles')->onDelete('cascade');
            $table->unsignedBigInteger('reviewer_id');  // id_nguoi_phan_bien -> reviewer_id
            $table->date('submission_date');            // ngay_gui -> submission_date
            $table->date('acceptance_date')->nullable(); // ngay_chap_nhan -> acceptance_date
            $table->text('evaluation')->nullable();                // danh_gia -> evaluation
            $table->text('revision_requirements')->nullable(); // yeu_cau_chinh_sua -> revision_requirements
            $table->text('notes')->nullable();          // ghi_chu -> notes
            $table->enum('status', ['Pending review', 'Reviewed', 'Rejected'])->default('Pending review'); // trang_thai -> status
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
        Schema::dropIfExists('reviews');
    }
};
