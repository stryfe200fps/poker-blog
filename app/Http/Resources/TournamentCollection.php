<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use App\Http\Resources\LOFApiEventIndexResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class TournamentCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        $series = $this->collection;


        $reducedCollection = $this->collection->groupBy(function ($date) {
            return Carbon::parse($date->date_start->format('F-Y'));
        })->reduce(function ($result, $item) {
            $result[] = [
                'date' => $item->first()->date_start->format('F-Y'),
                'collection' => collect($item)->map(function ($i) {
                    return new LOFApiTournamentResource($i);
                }) ?? []
            ];

            return $result;
        }, collect([]))->toArray();

        // dd('series: ', $series, 'reduced: ', $reducedCollection);


        return [
            'data' => $reducedCollection 
        ];
    }
}
