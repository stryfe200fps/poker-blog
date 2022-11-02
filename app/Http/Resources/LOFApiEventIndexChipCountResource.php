<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LOFApiEventIndexChipCountResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'event_chips' => collect(EventChipsResource::collection($this->latest_event_chips->sortByDesc('published_date')->unique('player_id')))->sortByDesc('current_chips')->values()->all(),
        ];
    }
}
