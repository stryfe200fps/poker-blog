<?php

namespace App\Http\Resources;

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

        if ($request->get('status') == null) {
            return;
        }

        $tournamentList = $this->collection->map(function ($tourna) use ($request) {
            $tourna->events = $tourna->events->filter(
                fn ($event) => $event->is_live == true && $event->status() == $request->get('status')
            );
            return $tourna;
        })->filter(function ($tourna) {
            return count($tourna->events);
        });

        return [
            'data' => TournamentEventResource::collection($tournamentList),
        ];
    }
}
