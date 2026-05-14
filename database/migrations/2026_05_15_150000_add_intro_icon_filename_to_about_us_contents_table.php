<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('about_us_contents', function (Blueprint $table) {
            $table->string('intro_icon_filename', 255)->nullable()->after('intro_icon');
        });
    }

    public function down(): void
    {
        Schema::table('about_us_contents', function (Blueprint $table) {
            $table->dropColumn('intro_icon_filename');
        });
    }
};
