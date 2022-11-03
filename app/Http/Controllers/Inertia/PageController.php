<?php

namespace App\Http\Controllers\Inertia;

use App\Http\Controllers\Controller;
use Backpack\PageManager\app\Models\Page;
use Inertia\Inertia;

class PageController extends Controller
{
    public function index($page, $other = null)
    {
        if ($page = Page::findBySlug($page)) {
            $webPage = \JsonLd\Context::create('web_page', [
                'description' => 'Home page',
                'url' => config('app.url').'/'.$page->slug,
            ]);

            return Inertia::render('Template/Index', [
                'title' => $page->title.' | LifeOfPoker',
                'json-ld-webpage' => $webPage,
                'description' => \Illuminate\Support\Str::limit($page->name, 100, $end = '...'),
                'page' => $page,
                'template' => $page->template

            ]);
        } else {
            return Inertia::render('Error/404');
        }
    }
}
