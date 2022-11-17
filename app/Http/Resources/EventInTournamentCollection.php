<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class EventInTournamentCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // dd($this->collection);
        $mapped = $this->collection->map(function ($result, $item) {
            return array_merge(
            [
                'status' => $result->status(), 
                'events' => collect($result->days->sortByDesc('lft')
                    ->map(fn ($item) => $item->load(['event_reports'])->event_reports->load('day')
                    ->sortByDesc('published_date')))
                    ->flatten()
                    ->take(2)
                    ->toArray()
            ]
            ,collect(new EventResource($result))->toArray());
        })->sortByDesc('id');


        $statusPriorities = ['live', 'upcoming', 'tba', 'past'];

        $newCollections = $mapped->sortBy(function ($order) use ($statusPriorities) {
            return array_search($order['status'], $statusPriorities);
        })->values()->all();

        return [
            'data' => $newCollections,
        ];
    }
}
