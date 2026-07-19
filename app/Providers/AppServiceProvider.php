<?php

namespace App\Providers;

use App\Models\MailSetting;
use App\Models\Page;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Throwable;

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
        $this->applyMailSettingsFromDatabase();

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

    private function applyMailSettingsFromDatabase(): void
    {
        try {
            if (! Schema::hasTable('mail_settings')) {
                return;
            }

            $settings = MailSetting::current();

            $overrides = [];

            if (filled($settings->mailer)) {
                $overrides['mail.default'] = $settings->mailer;
            }

            if (filled($settings->host)) {
                $overrides['mail.mailers.smtp.host'] = $settings->host;
            }

            if (filled($settings->port)) {
                $overrides['mail.mailers.smtp.port'] = $settings->port;
            }

            if (filled($settings->scheme)) {
                $overrides['mail.mailers.smtp.scheme'] = $settings->scheme;
            }

            if (filled($settings->username)) {
                $overrides['mail.mailers.smtp.username'] = $settings->username;
            }

            if (filled($settings->password)) {
                $overrides['mail.mailers.smtp.password'] = $settings->password;
            }

            if (filled($settings->from_address)) {
                $overrides['mail.from.address'] = $settings->from_address;
            }

            if (filled($settings->from_name)) {
                $overrides['mail.from.name'] = $settings->from_name;
            }

            if (filled($settings->admin_to)) {
                $overrides['mail.admin_to'] = $settings->admin_to;
            }

            if ($overrides !== []) {
                config($overrides);
            }
        } catch (Throwable) {
            // Table may not exist yet or DB may be unavailable; keep .env fallbacks.
        }
    }
}
