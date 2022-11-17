<?php

namespace App\Helpers;

use App\Models\Level;
use Illuminate\Database\Eloquent\Builder;

class LiveReportOrder
{
    public function handle(Builder $builder, $next)
    {
        $builder->orderByDesc(Level::select('level')
            ->whereColumn('levels.id', 'event_reports.level_id')
        )->orderByDesc('published_date');

        return $next($builder);
    }
}
