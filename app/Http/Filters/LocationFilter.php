<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;

class LocationFilter
{
    public function handle(Builder $builder, $next)
    {
        if (! request()->has('country')) {
            return $next($builder);
        }

        $test =  $next($builder)->whereHas('country', function ($q) {
                $q->where('iso_3166_2', request()->get('country'));
        });

        return $test;
    }
}
