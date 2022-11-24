<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\Author;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

final class BackpackTableService
{
    public static function title($link = null, $limit = null)
    {
        $link = $link !== null ? [ 'href' => $link ] : '';
               
        CRUD::addColumn([
            'name' => 'title',
            'limit' => $limit ?? 50,
            'wrapper' => $link 
        ]);
    } 
}
