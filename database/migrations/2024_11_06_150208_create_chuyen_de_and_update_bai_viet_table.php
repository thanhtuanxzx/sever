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
        // Create the 'categories' table (formerly 'chuyen_de')
        Schema::create('categories', function (Blueprint $table) {
            $table->id('category_id'); // Primary key column
            $table->string('name')->nullable(); // 'ten_chuyen_de' -> 'name'
            $table->text('description')->nullable(); // 'mo_ta' -> 'description'
            $table->timestamps(); // Timestamps for created_at and updated_at
        });

        // Update the 'articles' table (formerly 'bai_viet') to add foreign key referencing the 'categories' table
        Schema::table('articles', function (Blueprint $table) {
            // Add 'category_id' column to store the foreign key
            $table->unsignedBigInteger('category_id')->nullable();

            // Set the foreign key relationship from 'articles' to 'categories'
            $table->foreign('category_id')->references('category_id')->on('categories')
                  ->onDelete('set null'); // If the category is deleted, the 'category_id' will be set to null
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Drop the foreign key constraint and 'category_id' column from the 'articles' table
        Schema::table('articles', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
            $table->dropColumn('category_id');
        });

        // Drop the 'categories' table
        Schema::dropIfExists('categories');
    }
};
