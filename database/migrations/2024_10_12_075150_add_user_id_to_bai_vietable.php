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
        Schema::table('bai_viet', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->after('id_bai_viet')->nullable();
            // Nếu cần tạo ràng buộc khóa ngoại, bạn có thể thêm:
            // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
            $table->dropColumn('user_id');
        });
    }
};
