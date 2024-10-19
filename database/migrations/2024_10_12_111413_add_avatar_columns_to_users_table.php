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
        Schema::table('users', function (Blueprint $table) {
            $table->string('avatar_original_name')->nullable();
            $table->string('avatar_mime_type')->nullable();
            $table->integer('avatar_size')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('avatar_original_name')->nullable();
            $table->string('avatar_mime_type')->nullable();
            $table->integer('avatar_size')->nullable();
        });
    }
};
