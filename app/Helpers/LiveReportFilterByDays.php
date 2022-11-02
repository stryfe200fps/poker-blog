<?php

namespace App\Helpers;

use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

class LiveReportFilterByDays
{
    public function handle(Builder $builder, $next)
    {
        if (! request()->has('filterDay')) {
            return $next($builder);
        }

        // dd(request()->get('event'));

        // $event = Event::where('slug', request()->get('event'));

        // $dateStart = '';
        // $dateEnd = '';

        // foreach ($event->first()->schedule as $sched) {
        //     if (request()->get('filterDay') == $sched['day']) {
        //         $dateStart = Carbon::parse($sched['date_start']);
        //         $dateEnd = Carbon::parse($sched['date_end']);
        //     }
        // }

        // $c = $builder->whereBetween('published_date', [$dateStart, $dateEnd]);
        // $c = $builder->whereHas('day', request()->get('filterDay'));

        return $next($builder);
    }
}
