<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('our_work_projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('our_work_content_id')->constrained('our_work_contents')->cascadeOnDelete();
            $table->unsignedInteger('sort_order')->default(0);
            $table->string('title')->nullable();
            $table->text('body')->nullable();
            $table->string('icon', 64)->nullable();
            $table->text('image_path')->nullable();
            $table->string('link_label')->nullable();
            $table->string('link_url', 512)->nullable();
            $table->timestamps();

            $table->index(['our_work_content_id', 'sort_order']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('our_work_projects');
    }
};
