<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ArticleCategory;
use App\Http\Resources\ArticleCategoryResource;

class ArticleCategoryController extends Controller
{
    public function index()
    {
        return ArticleCategoryResource::collection( ArticleCategory::all());
    }
}
