<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Day;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

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
            return $item->hasOriginalImage() && !$item->hasImage();
          }) as $report) {
            $ids[] = $report->media[0]->id;

            Cache::put('event-report-'.$report->id, $report->media[0]->uuid , config('app.image_cache_lifetime') );
          }
            $datx=  collect($ids)->map(function ($data) {

            return '--ids='.$data ;
            })->toArray() ;

            \Artisan::call("media-library:regenerate ". implode(' ', $datx) );
        }

        return $next($request);
    }
}
