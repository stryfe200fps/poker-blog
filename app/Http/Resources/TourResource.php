<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TourResource extends JsonResource
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
            'title' => googleTranslateExclude($this->title),
            'title_tab' => $this->title ?? '',
            'slug' => $this->slug,
            'image_set' => $this->allMedia(),
            'description' => $this->description,
            'content' => googleTranslateExclude($this->content),
            'tournaments' => TournamentResource::collection($this->tournaments)
        ];
    }
}
