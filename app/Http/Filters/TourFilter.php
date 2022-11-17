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

        $test =  $next($builder)->whereHas('tour', function ($q) {
                $q->where('slug', request()->get('tour'));

        });
        return $test;
    }
}
