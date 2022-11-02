<?php

namespace App\Http\Resources;

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
        return [
            'data' => LOFApiTournamentResource::collection($this->collection)
        ];
    }
}
