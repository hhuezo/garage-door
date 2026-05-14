<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Elimina el CMS genérico por secciones/snippets/multimedia vinculado a page_section_items.
     * About Us usa tablas propias (about_us_contents, about_us_cards).
     */
    public function up(): void
    {
        Schema::dropIfExists('page_section_items');
        Schema::dropIfExists('page_sections');
        Schema::dropIfExists('page_text_snippets');
        Schema::dropIfExists('media_files');
    }

    public function down(): void
    {
        // Irreversible: las tablas y datos del CMS legado no se restauran automáticamente.
    }
};
