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
        Schema::table('citations', function (Blueprint $table) {
            $table->unsignedBigInteger('article_id')->after('link'); // Add article_id column
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('citations', function (Blueprint $table) {
            $table->dropColumn('article_id'); // Drop article_id column
        });
    }
};
