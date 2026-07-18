<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('home_contents', function (Blueprint $table) {
            $table->string('social_instagram_url', 512)->nullable()->after('map_embed_url');
            $table->string('social_facebook_url', 512)->nullable()->after('social_instagram_url');
            $table->string('social_tiktok_url', 512)->nullable()->after('social_facebook_url');
        });
    }

    public function down(): void
    {
        Schema::table('home_contents', function (Blueprint $table) {
            $table->dropColumn([
                'social_instagram_url',
                'social_facebook_url',
                'social_tiktok_url',
            ]);
        });
    }
};
