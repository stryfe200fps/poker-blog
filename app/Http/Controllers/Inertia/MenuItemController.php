<?php

namespace App\Http\Controllers\Inertia;

use Exception;
use Inertia\Inertia;
use App\Models\MenuItem;
use Illuminate\Routing\Route;
use App\Http\Controllers\Controller;

class MenuItemController extends Controller
{
    public function index()
    {
         try { 

foreach (MenuItem::getTree() as $item) {

    if ($item->link == null)
    return ;

    foreach ($item->children as $child) {
        if ($item->link === $child->link) {

            Route::get($item->link, function () use ($item) {
                    return Inertia::render('Categories/CategoryPage', [
                        'title' => '',
                        'description' => 'asdasd',
                        'page' => 'news'
                    ]);
                });
        }
        Route::get($item->link. '/' .$child->link, function () use ($child) {
            return Inertia::render('Categories/CategoryPage', [
                'title' => $child->name,
                'description' => $child->name,
                'page' => $child->link
            ]);
        });
    }
} }  catch (Exception $e) {


}
    }

}