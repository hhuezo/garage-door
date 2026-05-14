<?php

use App\Models\AboutUsContent;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('about_us_contents', function (Blueprint $table) {
            $table->string('values_section_heading', 255)->nullable()->after('intro_icon_filename');
            $table->string('values_section_logo_filename', 255)->nullable()->after('values_section_heading');
        });

        AboutUsContent::query()->whereNull('values_section_heading')->update(['values_section_heading' => 'Valores']);
    }

    public function down(): void
    {
        Schema::table('about_us_contents', function (Blueprint $table) {
            $table->dropColumn(['values_section_heading', 'values_section_logo_filename']);
        });
    }
};
