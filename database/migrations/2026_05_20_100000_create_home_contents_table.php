<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('home_contents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('page_id')->unique()->constrained('pages')->cascadeOnDelete();
            $table->text('hero_bg_image_filename')->nullable();
            $table->string('hero_title_line1')->nullable();
            $table->string('hero_title_line2')->nullable();
            $table->string('hero_title_accent')->nullable();
            $table->longText('hero_lead')->nullable();
            $table->string('hero_cta_primary_label')->nullable();
            $table->string('hero_cta_secondary_label')->nullable();
            $table->text('hero_inset_image_filename')->nullable();
            $table->string('about_heading')->nullable();
            $table->string('about_subheading')->nullable();
            $table->string('about_link_label')->nullable();
            $table->longText('about_paragraph_1')->nullable();
            $table->longText('about_paragraph_2')->nullable();
            $table->string('services_heading_primary')->nullable();
            $table->string('services_heading_accent')->nullable();
            $table->string('work_heading_primary')->nullable();
            $table->string('work_heading_accent')->nullable();
            $table->longText('work_intro')->nullable();
            $table->string('work_cta_label')->nullable();
            $table->text('work_main_image_filename')->nullable();
            $table->string('reviews_heading_primary')->nullable();
            $table->string('reviews_heading_accent')->nullable();
            $table->string('reviews_cta_label')->nullable();
            $table->string('contact_heading')->nullable();
            $table->string('contact_phone')->nullable();
            $table->string('contact_email')->nullable();
            $table->text('map_embed_url')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('home_contents');
    }
};
