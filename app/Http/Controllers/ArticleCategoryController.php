<?php

namespace App\Http\Controllers;

use App\Http\Resources\ArticleCategoryResource;
use App\Models\ArticleCategory;

class ArticleCategoryController extends Controller
{
    public function index()
    {
        return ArticleCategoryResource::collection(ArticleCategory::all());
    }
}
