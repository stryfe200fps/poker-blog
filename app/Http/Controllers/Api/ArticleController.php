<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ArticleResource;
use App\Models\Article;
use App\Models\ArticleTag;

class ArticleController extends Controller
{
    public function index()
    {
        return  ArticleResource::collection(Article::with(['article_author', 'media', 'article_categories'])->latest()->paginate(10));
    }

    public function show($slug)
    {
        return new ArticleResource(Article::where('slug', $slug)->first());
    }

    public function tag($tag)
    {
        dd(ArticleTag::where('title', $tag)->first()->articles);

        return ArticleResource::collection(ArticleTag::where('title', $tag)->first()->articles->paginate(10));
    }
}
