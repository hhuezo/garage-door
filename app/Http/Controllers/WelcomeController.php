<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Support\Collection;
use Illuminate\View\View;

class WelcomeController extends Controller
{
    public function __invoke(): View
    {
        $page = Page::query()
            ->where('slug', 'welcome')
            ->with(['homeContent.stats', 'homeContent.testimonials'])
            ->first();

        $homeContent = $page?->homeContent;

        $servicesPage = Page::query()
            ->where('slug', 'services')
            ->with(['servicesContent.cards'])
            ->first();

        $serviceCards = $servicesPage?->servicesContent?->cards ?? new Collection;

        return view('welcome', [
            'page' => $page,
            'homeContent' => $homeContent,
            'serviceCards' => $serviceCards,
        ]);
    }
}
