<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('home_testimonials', function (Blueprint $table) {
            $table->id();
            $table->foreignId('home_content_id')->constrained('home_contents')->cascadeOnDelete();
            $table->unsignedInteger('sort_order')->default(0);
            $table->text('quote')->nullable();
            $table->string('icon', 64)->nullable();
            $table->timestamps();

            $table->index(['home_content_id', 'sort_order']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('home_testimonials');
    }
};
