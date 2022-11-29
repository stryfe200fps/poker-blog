<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use App\Http\Resources\EventResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CalendarTournamentCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        $date = request()->get('date_start');
        $reducedCollection = $this->collection->groupBy(function ($date) {
            return Carbon::parse($date->date_start->format('F-Y'));
        })->reduce(function ($result, $item) use ($date) {
            $result[] = [
                'date' =>  $item->first()->date_start->format('F-Y'),
                'collection' => collect($item)->map(function ($i) {
                    return new TournamentEventResource($i);
                }) ?? []
            ];

            return $result;
        }, collect([]))->toArray();

        return [
            'data' => $reducedCollection
        ];
    }
}
