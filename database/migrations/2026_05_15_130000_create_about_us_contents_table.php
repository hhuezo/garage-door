<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('about_us_contents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('page_id')->unique()->constrained('pages')->cascadeOnDelete();
            $table->text('hero_eyebrow')->nullable();
            $table->text('hero_title')->nullable();
            $table->longText('intro')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('about_us_contents');
    }
};
