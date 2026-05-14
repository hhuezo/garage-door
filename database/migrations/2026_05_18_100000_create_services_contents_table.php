<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('services_contents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('page_id')->unique()->constrained('pages')->cascadeOnDelete();
            $table->string('hero_title')->nullable();
            $table->longText('hero_lead')->nullable();
            $table->string('hero_image_filename', 255)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('services_contents');
    }
};
