<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('page_text_snippets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('page_id')->constrained()->cascadeOnDelete();
            $table->string('field_key');
            $table->text('value');
            $table->string('locale', 8)->default('en');
            $table->timestamps();

            $table->unique(['page_id', 'field_key', 'locale']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('page_text_snippets');
    }
};
