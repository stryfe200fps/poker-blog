<?php

namespace App\Http\Controllers\Inertia;

use Inertia\Inertia;
use App\Models\Article;
use App\Models\EventReport;
use App\Http\Controllers\Controller;
use Backpack\PageManager\app\Models\Page;
use App\Http\Resources\LOFApiEventReportsResource;

class PageController extends Controller
{
    public function index($page, $other = null) {

    if ($page = Page::findBySlug($page)) {
        return Inertia::render('Template/Index', [
            'title' => $page->name,
            'description' => \Illuminate\Support\Str::limit($page->name, 100, $end = '...'),
            'page' => $page,

        ]);
    } else {
        return Inertia::render('Error/404');
    }
}

}