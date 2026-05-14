<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('pages')
            || ! Schema::hasTable('page_text_snippets')
            || ! Schema::hasTable('about_us_contents')
            || ! Schema::hasTable('about_us_cards')) {
            return;
        }

        $pageId = DB::table('pages')->where('slug', 'about-us')->value('id');
        if (! $pageId || DB::table('about_us_contents')->where('page_id', $pageId)->exists()) {
            return;
        }

        $eyebrow = DB::table('page_text_snippets')->where('page_id', $pageId)->where('field_key', 'hero_eyebrow')->value('value');
        $title = DB::table('page_text_snippets')->where('page_id', $pageId)->where('field_key', 'hero_title')->value('value');
        $intro = DB::table('page_text_snippets')->where('page_id', $pageId)->where('field_key', 'intro')->value('value');

        $now = now();
        $contentId = DB::table('about_us_contents')->insertGetId([
            'page_id' => $pageId,
            'hero_eyebrow' => $eyebrow,
            'hero_title' => $title,
            'intro' => $intro,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        if (Schema::hasTable('page_sections') && Schema::hasTable('page_section_items')) {
            $sectionId = DB::table('page_sections')->where('page_id', $pageId)->where('section_key', 'value_cards')->value('id');
            if ($sectionId) {
                $items = DB::table('page_section_items')
                    ->where('page_section_id', $sectionId)
                    ->orderBy('sort_order')
                    ->get();

                foreach ($items as $item) {
                    $extra = $item->extra;
                    if (is_string($extra)) {
                        $extra = json_decode($extra, true);
                    }
                    $icon = is_array($extra) ? ($extra['icon'] ?? null) : null;

                    DB::table('about_us_cards')->insert([
                        'about_us_content_id' => $contentId,
                        'sort_order' => $item->sort_order,
                        'title' => $item->title,
                        'body' => $item->body,
                        'link_label' => $item->link_label,
                        'link_url' => $item->link_url,
                        'image_filename' => $item->image_filename,
                        'icon' => $icon,
                        'created_at' => $now,
                        'updated_at' => $now,
                    ]);
                }

                DB::table('page_section_items')->where('page_section_id', $sectionId)->delete();
                DB::table('page_sections')->where('id', $sectionId)->delete();
            }
        }

        DB::table('page_text_snippets')->where('page_id', $pageId)->delete();
    }

    public function down(): void
    {
        if (! Schema::hasTable('pages') || ! Schema::hasTable('about_us_contents')) {
            return;
        }

        $pageId = DB::table('pages')->where('slug', 'about-us')->value('id');
        if (! $pageId) {
            return;
        }

        DB::table('about_us_contents')->where('page_id', $pageId)->delete();
    }
};
