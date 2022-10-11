<?php

namespace App\Http\Controllers;

use Backpack\PageManager\app\Models\Page;

class PageManagerController extends Controller
{
    public function index()
    {
        $page = Page::all();

        return $page;
    }

    public function show($slug)
    {
        $page = Page::all();

        return $page;
    }
}
