<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class LOFApiEventsCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {


        $mapped =  $this->collection->map(function ($result, $item) {
            return array_merge(['status' => $result->status(), 'events' => collect($result->event_reports->take(2))->toArray() ],  collect(new LOFApiEventsResource($result))->toArray() );
        })->sortByDesc('id');
               
        $statusPriorities = ['live', 'upcoming', 'tba', 'past'];
        
       $newCollections = $mapped->sortBy(function($order) use($statusPriorities){
           return array_search($order['status'], $statusPriorities);
        })->values()->all();


        return [
            'data' => $newCollections 
        ];
    }
}
