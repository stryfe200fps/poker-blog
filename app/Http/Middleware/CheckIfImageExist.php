<?php

namespace App\Http\Middleware;

use App\Models\Day;
use Closure;
use Illuminate\Http\Request;

class CheckIfImageExist
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $day = Day::find($request->day);

        if (! $day->hasImageInStorage()) {

          $ids = [];
          foreach ($day->event_reports()->get()->filter(function ($item) {
            return $item->hasOriginalImage();
          }) as $report) {
            $ids[] = $report->id;
          }
        $datx=  collect($ids)->map(function ($data) {
            return '--ids='.$data ;
            })->toArray() ;

          \Artisan::call("media-library:regenerate ". implode(' ', $datx) );

        }

        return $next($request);
    }
}
