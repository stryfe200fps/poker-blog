<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;

class StatusFilter
{
    public function handle(Builder $builder, $next)
    {
        if (! request()->has('status')) {
            return $next($builder);
        }

        $test =  $next($builder)->where('status', 1);

        return $test;
    }
}
