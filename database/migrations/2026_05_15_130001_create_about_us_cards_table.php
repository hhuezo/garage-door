<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('about_us_cards', function (Blueprint $table) {
            $table->id();
            $table->foreignId('about_us_content_id')->constrained('about_us_contents')->cascadeOnDelete();
            $table->unsignedInteger('sort_order')->default(0);
            $table->string('title')->nullable();
            $table->text('body')->nullable();
            $table->string('link_label')->nullable();
            $table->string('link_url', 2048)->nullable();
            $table->string('image_filename')->nullable();
            $table->string('icon', 64)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('about_us_cards');
    }
};
