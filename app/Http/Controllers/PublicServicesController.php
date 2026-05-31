<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\View\View;

class PublicServicesController extends Controller
{
    public function __invoke(): View
    {
        $page = Page::query()
            ->where('slug', 'services')
            ->with(['servicesContent.cards'])
            ->firstOrFail();

        $servicesContent = $page->servicesContent;
        if (! $servicesContent) {
            abort(404);
        }

        $homeContent = Page::query()
            ->where('slug', 'welcome')
            ->with('homeContent')
            ->first()?->homeContent;

        $aboutContent = Page::query()
            ->where('slug', 'about-us')
            ->with('aboutUsContent')
            ->first()?->aboutUsContent;

        return view('services', [
            'page' => $page,
            'servicesContent' => $servicesContent,
            'homeContent' => $homeContent,
            'aboutContent' => $aboutContent,
        ]);
    }
}
