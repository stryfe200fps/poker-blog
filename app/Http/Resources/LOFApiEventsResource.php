<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LOFApiEventsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    // public function toArray($request)
    // {
    //     return parent::toArray($request);
    // }

    public function toArray($request)
    {
        return [
            'status' => $this->status(),
            'id' => $this->id,
            'slug' => $this->slug,
            'title' => googleTranslateExclude($this->title)[0] ?? '',
            'title_tab' => $this->title ?? '',
            'description' => $this->description,
            'content' => googleTranslateExclude($this->content),
            'image' => $this->image,
            'tournament' => $this->tournament->title,
            'tournament_slug' => $this->tournament->slug,
            'tour_slug' => $this->tour()->firstOrFail()->slug,
            'schedule' => $this->schedule,
            'date_start' => $this->date_start?->date_start ?? '' ,
            'date_end' => $this->date_start?->date_end ?? '' ,

            'buyin' => $this->buyin,
            'fee' => $this->fee,
            'game_table' => $this->event_game_table?->title,

        ];
    }
}
