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
            // Add new columns to the users table
            $table->string('title')->nullable()->after('token');        // Title
            $table->string('gender')->nullable()->after('title');     // Gender
            $table->string('role')->default('4')->nullable()->after('gender');        // Role
            $table->text('bio')->nullable()->after('role');            // Biography
            $table->string('website_url')->nullable()->after('bio');        // Website URL
            $table->string('avatar')->nullable()->after('website_url');        // Avatar (URL or file name)

            // Add file-related columns (for avatar)
            $table->string('file_name')->nullable()->after('avatar');   // Avatar file name
            $table->string('file_path')->nullable()->after('file_name'); // File path
            $table->string('file_mime_type')->nullable()->after('file_path');  // MIME type of the file
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
            // Drop columns when rolling back the migration
            $table->dropColumn('title');
            $table->dropColumn('gender');
            $table->dropColumn('role');
            $table->dropColumn('bio');
            $table->dropColumn('website_url');
            $table->dropColumn('avatar');
            $table->dropColumn('file_name');
            $table->dropColumn('file_path');
            $table->dropColumn('file_mime_type');
        });
    }
};
