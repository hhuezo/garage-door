<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\View\View;

class PublicOurWorkController extends Controller
{
    public function __invoke(): View
    {
        $page = Page::query()
            ->where('slug', 'our-work')
            ->with(['ourWorkContent.projects'])
            ->firstOrFail();

        $ourWorkContent = $page->ourWorkContent;
        if (! $ourWorkContent) {
            abort(404);
        }

        return view('our_work', [
            'page' => $page,
            'ourWorkContent' => $ourWorkContent,
        ]);
    }
}
