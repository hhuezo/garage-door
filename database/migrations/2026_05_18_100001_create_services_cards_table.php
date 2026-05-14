<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('services_cards', function (Blueprint $table) {
            $table->id();
            $table->foreignId('services_content_id')->constrained('services_contents')->cascadeOnDelete();
            $table->unsignedInteger('sort_order')->default(0);
            $table->string('title')->nullable();
            $table->text('body')->nullable();
            $table->string('icon', 64)->nullable();
            $table->text('image_path')->nullable();
            $table->string('theme', 16)->default('light');
            $table->timestamps();

            $table->index(['services_content_id', 'sort_order']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('services_cards');
    }
};
