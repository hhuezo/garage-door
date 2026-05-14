<?php

use App\Models\AboutUsContent;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('about_us_contents', function (Blueprint $table) {
            $table->string('hero_image_filename', 255)->nullable()->after('intro');
            $table->string('intro_icon', 64)->nullable()->after('hero_image_filename');
        });

        AboutUsContent::query()
            ->with(['cards' => fn ($q) => $q->orderBy('sort_order')])
            ->get()
            ->each(function (AboutUsContent $row): void {
                if ($row->hero_image_filename !== null && $row->hero_image_filename !== '') {
                    return;
                }
                $first = $row->cards->first();
                if ($first && ! empty($first->image_filename)) {
                    $row->update(['hero_image_filename' => $first->image_filename]);
                }
            });
    }

    public function down(): void
    {
        Schema::table('about_us_contents', function (Blueprint $table) {
            $table->dropColumn(['hero_image_filename', 'intro_icon']);
        });
    }
};
