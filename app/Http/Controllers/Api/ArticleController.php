<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ArticleResource;
use App\Models\Article;

class ArticleController extends Controller
{
    public function index()
    {
        return  ArticleResource::collection(Article::paginate(10));
    }

    public function show($slug)
    {
    }
}
