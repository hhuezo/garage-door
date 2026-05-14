<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('our_work_contents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('page_id')->unique()->constrained('pages')->cascadeOnDelete();
            $table->string('hero_title_primary')->default('Our');
            $table->string('hero_title_accent')->default('Work');
            $table->string('hero_icon', 64)->nullable();
            $table->longText('hero_intro')->nullable();
            $table->string('hero_cta_label')->nullable();
            $table->string('hero_cta_url', 512)->nullable();
            $table->string('hero_main_image_filename', 255)->nullable();
            $table->string('hero_inset_image_filename', 255)->nullable();
            $table->string('stat_value', 64)->nullable();
            $table->string('stat_caption')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('our_work_contents');
    }
};
