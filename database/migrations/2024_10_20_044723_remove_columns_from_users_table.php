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
            $table->dropColumn([
                'profile_image',
                'file_name',
                'file_path',
                'file_mime_type',
                'avatar_original_name',
                'avatar_mime_type',
                'avatar_size',
            ]);
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
            $table->string('profile_image')->nullable();
            $table->string('file_name')->nullable();
            $table->string('file_path')->nullable();
            $table->string('file_mime_type')->nullable();
            $table->string('avatar_original_name')->nullable();
            $table->string('avatar_mime_type')->nullable();
            $table->integer('avatar_size')->nullable();
        });
    }
};
