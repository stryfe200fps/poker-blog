<?php

namespace App\Http\Controllers\Inertia;

use App\Http\Controllers\Controller;
use App\Http\Resources\ArticleResource;
use App\Models\Article;
use Inertia\Inertia;

class ArticleController extends Controller
{
    public function index()
    {
       return Inertia::render('Categories/CategoryPage', [
                        'title' => ' LifeOfPoker',
                        'description' => 'News',
                        'page_title' => 'News',
                        // 'json-ld-webpage' => 'test',
                    ]);
    }

    public function showCategory($slug) 
    {

    }

    public function show($year, $month, $slug) 
    {
        $article = Article::where('slug', $slug)->firstOrFail();

        if ($month != $article->published_date->format('m') || $year != $article->published_date->format('Y')) {
            return redirect('/news/'. $article->published_date->format('Y'). '/'. $article->published_date->format('m') . '/'. $slug );
        }

        $webPage = \JsonLd\Context::create('web_page', [
            'url' => request()->url(),
        ]);

        $context = \JsonLd\Context::create('news_article', [
            'headline' => $article->title,
            'description' => $article->description,
            'mainEntityOfPage' => [
                'url' => config('app.url').'/news',

            ],
            'image' => [
                'url' => $article->getFirstMediaUrl('article', 'md-image'),
                'height' => 800,
                'width' => 800,
            ],
            'datePublished' => $article->published_date,
            'dateModified' => $article->updated_at,
            'author' => [
                'name' => $article?->author?->first_name,
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
                'title' => $article->title.' | LifeOfPoker',
                'slug' => $slug,
                'image' =>  $article->getFirstMediaUrl('article', 'md-image'),
                'json-ld-article' => $context,
                'json-ld-webpage' => $webPage,
                'description' => $article->description,
                // 'description' => \Illuminate\Support\Str::limit($article->description, 100, $end = '...'),
            ]);
    }

    public function tag($slug)
    {
        $webPage = \JsonLd\Context::create('web_page', [
            'url' => request()->url()
        ]);
        return Inertia::render('Tag/TagArticle', [
            'title' => 'Tag: '.$slug.' | LifeOfPoker',
            'slug' => $slug,
            'json-ld-webpage' => $webPage,
        ]);
    }



    public function article($slug)
    {
        return new ArticleResource(Article::where('slug', $slug));
    }
}
