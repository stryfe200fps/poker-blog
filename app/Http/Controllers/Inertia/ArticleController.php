<?php

namespace App\Http\Controllers\Inertia;

use Inertia\Inertia;
use App\Models\Article;
use App\Models\EventReport;
use App\Http\Controllers\Controller;
use App\Http\Resources\LOFApiEventReportsResource;

class ArticleController extends Controller
{
    public function index () 
    {
    $webPage = \JsonLd\Context::create('web_page', [
        'description' => 'Article',
        'url' => config('app.url').'/article',
    ]);

    return Inertia::render('Article/Index');
    }

    public function show($slug) {
    $article = Article::where('slug', $slug)->first();

    $webPage = \JsonLd\Context::create('web_page', [
        'description' => 'Home page',
        'url' => config('app.url').'/article/show/'.$slug,
    ]);

    $context = \JsonLd\Context::create('news_article', [
        'headline' => $article->title,
        'description' => $article->description,
        'mainEntityOfPage' => [
            'url' => config('app.url').'/article',

        ],
        'image' => [
            'url' => $article->getFirstMediaUrl('article'),
            'height' => 800,
            'width' => 800,
        ],
        'datePublished' => $article->published_date,
        'dateModified' => $article->updated_at,
        'author' => [
            'name' => $article?->article_author?->first_name,
        ],
        'publisher' => [
            'name' => 'Life of poker',
            'logo' => [
                'url' => config('app.url').'/lop_logo_small.png',
                'width' => 600,
                'height' => 60,
            ],
        ],
    ]);

    return Inertia::render('Article/Show',
        [
            'title' => $article->title,
            'slug' => $slug,
            'image' => $article->image,
            'json-ld-article' => $context,
            'json-ld-webpage' => $webPage,
            'description' => \Illuminate\Support\Str::limit($article->description, 100, $end = '...'),
        ]);
    }

    public function tag($slug) {
    return Inertia::render('Tag/TagArticle', [
        'slug' => $slug,
    ]);
}

}