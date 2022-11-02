<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;

class DateFilter
{
    public function handle(Builder $builder, $next)
    {
        if (! request()->has('date_start') && ! request()->has('date_end')) {
            return $next($builder);
        }

        $test =  $next($builder)->whereHas('days', function ($q) {
            $q->where('date_start','>=' , request()->get('date_start'));
            $q->where('date_end', '<=' , request()->get('date_end'));
        });
        return $test;
    }
}
