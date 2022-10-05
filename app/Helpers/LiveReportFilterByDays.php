<?php

namespace App\Helpers;

use Carbon\Carbon;
use App\Models\Event;
use Illuminate\Database\Eloquent\Builder;

class LiveReportFilterByDays
{
    public function handle(Builder $builder, $next)
    {
        if (! request()->has('filterDay')) {
            return $next($builder);
        }
        // dd(request()->get('event'));

        $event = Event::where('slug', request()->get('event'));

        $dateStart = '';
        $dateEnd = '';

        foreach ($event->first()->schedule as $sched) {
           if (request()->get('filterDay') == $sched['day']) {
                $dateStart = Carbon::parse($sched['date_start']);
                $dateEnd = Carbon::parse($sched['date_end']);
           }
        }

        $c = $builder->whereBetween('date_added', [$dateStart, $dateEnd]);

        return $next($builder);
    }
}
