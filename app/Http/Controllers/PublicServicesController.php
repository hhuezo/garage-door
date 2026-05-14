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

        return view('services', [
            'page' => $page,
            'servicesContent' => $servicesContent,
        ]);
    }
}
