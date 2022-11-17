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

            $page->content = googleTranslateExclude($page->content);

            $description = '';

            if ($page->extras != null)  { 
                if (array_key_exists('description', $page->extras))  
                    $description = $page->extras['description'];
            } else {
                $description = null;
            }

            return Inertia::render('Template/Index', [
                'title' => $page->title.' | LifeOfPoker',
                'json-ld-webpage' => $webPage,
                'description' =>  $description,
                'page' => $page,
            ]);
        } else {
            return Inertia::render('Error/404');
        }
    }
}
