<?php

namespace App\Helpers;

use App\Models\Level;
use Illuminate\Database\Eloquent\Builder;

class LiveReportFilterByDays {

    public function handle(Builder $builder, $next)
    {
        if ( !request()->has('filterDay'))
            return $next($builder);

        $builder->where('day', request()->get('filterDay') );

        // $builder->orderBy('id');


        // dd($builder->get());
        return $next($builder);
    }

}
