<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('about_us_contents', function (Blueprint $table) {
            $table->text('cta_banner_heading')->nullable()->after('values_section_logo_filename');
            $table->string('cta_banner_logo_filename')->nullable()->after('cta_banner_heading');
            $table->string('cta_banner_whatsapp_label')->nullable()->after('cta_banner_logo_filename');
            $table->string('cta_banner_whatsapp_url', 512)->nullable()->after('cta_banner_whatsapp_label');
            $table->string('cta_banner_email_label')->nullable()->after('cta_banner_whatsapp_url');
            $table->string('cta_banner_email')->nullable()->after('cta_banner_email_label');
        });
    }

    public function down(): void
    {
        Schema::table('about_us_contents', function (Blueprint $table) {
            $table->dropColumn([
                'cta_banner_heading',
                'cta_banner_logo_filename',
                'cta_banner_whatsapp_label',
                'cta_banner_whatsapp_url',
                'cta_banner_email_label',
                'cta_banner_email',
            ]);
        });
    }
};
