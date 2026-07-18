<?php

namespace App\Providers;

use App\Models\Page;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('partials.social_follow_links', function ($view) {
            $content = Page::query()
                ->where('slug', 'welcome')
                ->with('homeContent')
                ->first()
                ?->homeContent;

            $view->with('socialLinks', [
                'instagram' => $content?->social_instagram_url ?? 'https://www.instagram.com/TwinsGarageDoors/',
                'facebook' => $content?->social_facebook_url ?? 'https://www.facebook.com/thegaragedoorsR/',
                'tiktok' => $content?->social_tiktok_url ?? 'https://www.tiktok.com/@twinskbkce0?_r=1&_t=ZP-97DkpBKMzPi',
            ]);
        });
    }
}
