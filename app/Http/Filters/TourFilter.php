<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;

class TourFilter
{
    public function handle(Builder $builder, $next)
    {
        if (! request()->has('tour')) {
            return $next($builder);
        }

        $test =  $next($builder)->whereHas('tournament', function ($q) {
            $q->whereHas('tour', function ($queryCountry) {
                $queryCountry->where('slug', request()->get('tour'));
            });
        });
        return $test;
    }
}
