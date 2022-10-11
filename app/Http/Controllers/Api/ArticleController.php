<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ArticleResource;
use App\Models\Article;
use App\Models\ArticleCategory;
use App\Models\ArticleTag;

class ArticleController extends Controller
{
    public function index()
    {
        return  ArticleResource::collection(Article::with(['article_author', 'media', 'article_categories'])->latest()->limit(6)->get());
    }

    public function show($slug)
    {
        return new ArticleResource(Article::where('slug', $slug)->first());
    }

    public function related($slug)
    {
        return ArticleResource::collection(Article::where('slug', $slug)->first()->relatedArticles());
    }

    public function articleCategory($slug)
    {
        return ArticleResource::collection(ArticleCategory::where('slug', $slug)->firstOrFail()->articles()->latest()->paginate(5));
    }

    public function tag($tag)
    {
        return ArticleResource::collection(ArticleTag::where('title', $tag)->first()->articles->paginate(10));
    }
}
