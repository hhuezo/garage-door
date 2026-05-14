<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('page_section_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('page_section_id')->constrained('page_sections')->cascadeOnDelete();
            $table->unsignedInteger('sort_order')->default(0);
            $table->string('item_type', 64)->nullable();
            $table->string('title')->nullable();
            $table->string('subtitle')->nullable();
            $table->text('body')->nullable();
            $table->string('link_label')->nullable();
            $table->string('link_url', 2048)->nullable();
            $table->foreignId('image_id')->nullable()->constrained('media_files')->nullOnDelete();
            $table->string('image_filename')->nullable();
            $table->json('extra')->nullable();
            $table->timestamps();

            $table->index(['page_section_id', 'sort_order']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('page_section_items');
    }
};
