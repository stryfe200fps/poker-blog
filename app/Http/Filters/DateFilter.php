<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;

class DateFilter
{
    public function handle(Builder $builder, $next)
    {
        if (! request()->has('date_start') ) {
            return $next($builder);
        }

        $test =  $next($builder)->where(function ($q) {
            $q->where('date_start','>=' , request()->get('date_start'));
        });
        return $test;
    }
}
