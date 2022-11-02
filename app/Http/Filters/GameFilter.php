<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;

class GameFilter
{
    public function handle(Builder $builder, $next)
    {
        if (! request()->has('game')) {
            return $next($builder);
        }

        $test =  $next($builder)->whereHas('events', function ($q) {
            $q->whereHas('event_game_table', function ($queryGameTable) {
                $queryGameTable->where('code', request()->get('game'));
            });
        });
        return $test;
    }
}
