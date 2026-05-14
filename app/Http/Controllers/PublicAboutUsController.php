<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\View\View;

class PublicAboutUsController extends Controller
{
    public function __invoke(): View
    {
        $page = Page::query()
            ->where('slug', 'about-us')
            ->with(['aboutUsContent.cards'])
            ->firstOrFail();

        $aboutContent = $page->aboutUsContent;
        if (! $aboutContent) {
            abort(404);
        }

        return view('about_us', [
            'page' => $page,
            'aboutContent' => $aboutContent,
        ]);
    }
}
