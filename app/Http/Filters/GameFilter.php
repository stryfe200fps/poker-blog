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

        $test =  $next($builder)->whereHas('event_game_table', function ($q) {
            $q->where('code', request()->get('game'));
        });
        return $test;
    }
}
