<?php

namespace App\Http\Filters;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

class StatusFilter
{
    public function handle(Builder $builder, $next)
    {
        if (! request()->has('status')) {
            return $next($builder);
        }


        $status = request()->get('status');


        $test =  $next($builder)->whereHas('days', function ($q) use ($status) {

            if ($status === 'live') 
                $q->where('date_start', '<=' , Carbon::now())
                ->where('date_end', '>=', Carbon::now());
            
            if ($status === 'upcoming')
                $q->where('date_start', '>=' , Carbon::now());

            if ($status === 'end')
                $q->where('date_end', '<=' , Carbon::now());

        } );

        return $test;
    }
}
