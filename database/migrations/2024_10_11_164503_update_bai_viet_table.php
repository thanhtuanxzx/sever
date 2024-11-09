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
        Schema::table('articles', function (Blueprint $table) {
            // Drop unnecessary columns
            $table->dropColumn(['file_name', 'file_path', 'file_mime_type']);

            // Add new columns
            $table->string('original_name')->nullable();  // original_name column
            $table->string('generated_name')->nullable(); // generated_name column
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('articles', function (Blueprint $table) {
            // Add back the dropped columns
            $table->string('file_name')->nullable();  
            $table->string('file_path')->nullable();  
            $table->string('file_mime_type')->nullable();

            // Drop the new columns
            $table->dropColumn('original_name');  
            $table->dropColumn('generated_name'); 
        });
    }
};
