<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\Tour;
use App\Models\Tournament;
use App\Models\ArticleCategory;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

final class BackpackFilterService
{

  public static function tours($model)
  {
      CRUD::addFilter([
            'type' => 'select2',
            'name' => 'tour_filter',
            'label' => 'Tours',
        ],
            fn () => Tour::all()->sortBy('title')->pluck('title', 'id')->toArray(),
            fn ($values) => $model->crud->query
                ->whereHas('tour', fn ($query) => $query->where('id', $values))
          );
    
  }

  public static function tournaments($model)
  {
  CRUD::addFilter([
            'name'  => 'tournament_id',
            'type'  => 'select2',
            'label' => 'Series'
        ],fn () => Tournament::all()->sortBy('title')->pluck('title', 'id')->toArray()
         , fn ($value) => $model->crud->addClause('where', 'tournament_id', $value)
        );


  }

  public static function timezone($model)
  {
    CRUD::addFilter([
            'name'  => 'timezone_filter',
            'type'  => 'select2',
            'label' => 'Timezone'
        ], fn () => \Timezone::getTimezones()
        , fn ($value) => 
             $model->crud->query->whereHas('tournament', 
             fn ($query) => $query->where('timezone', $value)
            )
        );
  }

  public static function articleCategories($model)
  {
    CRUD::addFilter(
            [
                'type' => 'select2',
                'name' => 'article_categories',
                'label' => 'Category',
            ],
            fn () => ArticleCategory::all()->sortBy('title')->pluck('title', 'id')->toArray(),
            fn ($values)  => 
                $model->crud->query->whereHas('article_categories', fn ($query) =>
                    $query->where('id', $values)
                )
        );
  }
}