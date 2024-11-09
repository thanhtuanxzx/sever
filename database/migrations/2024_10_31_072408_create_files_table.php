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
        // Create the 'files' table (formerly 'file')
        Schema::create('file', function (Blueprint $table) {
            $table->id('file_id'); // Primary key for the files table
            $table->unsignedBigInteger('article_id'); // Foreign key linking to the articles table
            $table->string('file_name')->nullable(); // 'file_name' column
            $table->string('file_path')->nullable(); // 'file_path' column
            $table->string('file_mime_type')->nullable(); // 'file_mime_type' column
            $table->timestamps(); // Timestamps for created_at and updated_at

            // Define the foreign key relationship
            $table->foreign('article_id')->references('article_id')->on('articles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Drop the 'files' table if it exists
        Schema::dropIfExists('file');
    }
};
