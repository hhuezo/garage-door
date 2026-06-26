<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('our_work_contents', function (Blueprint $table) {
            $table->string('cta_heading')->nullable()->after('stat_caption');
            $table->longText('cta_body')->nullable()->after('cta_heading');
            $table->string('cta_call_label')->nullable()->after('cta_body');
            $table->string('cta_quote_label')->nullable()->after('cta_call_label');
            $table->string('cta_image_filename', 255)->nullable()->after('cta_quote_label');
            $table->string('cta_icon', 64)->nullable()->after('cta_image_filename');
        });
    }

    public function down(): void
    {
        Schema::table('our_work_contents', function (Blueprint $table) {
            $table->dropColumn([
                'cta_heading',
                'cta_body',
                'cta_call_label',
                'cta_quote_label',
                'cta_image_filename',
                'cta_icon',
            ]);
        });
    }
};
