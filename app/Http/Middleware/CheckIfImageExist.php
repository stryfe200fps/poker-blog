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
          // look for reports media that has no image conversions
          $currentReports = $day->event_reports()->get()->filter(function ($item) {
            return $item->hasOriginalImage() && !$item->hasImage(); });

          foreach ($currentReports as $report) {
            $ids[] = $report->media[0]->id;
            Cache::put('event-report-'.$report->id, $report->media[0]->uuid , config('app.image_cache_lifetime') );
          }

            // Manipulate ids from [0=>200, 1=>300] to --ids=200 --ids=300
            $formattedIds=  collect($ids)->map(function ($data) {
            return '--ids='.$data ;
            })->toArray() ;

            //artisan command to restore the deleted image conversion
            // \Artisan::call("media-library:regenerate ". implode(' ', $formattedIds) );
        }

        return $next($request);
    }
}
