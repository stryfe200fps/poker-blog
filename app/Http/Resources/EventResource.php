<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
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
          'id' => $this->id,
'slug' => $this->slug,
'title' => googleTranslateExclude($this->title)[0] ?? '',
'title_tab' => $this->title ?? '',
'status' => $this->status(),
'schedule' => $this->schedule,
'date_range' => $this->schedule,
'image' => $this->image,
'image_set' => $this->allMedia(),
'tournament' => $this->tournament->title,
'country' => $this->tournament->load('country')->country,
'currency' => $this->tournament->currency,
'available_days' => $this->getSchedule(),
'available_day_with_reports' => $this->getScheduleWithReports(),
'tour_slug' => $this->tournament->tour->slug,
'tournament_slug' => $this->tournament->slug,
'buyin' => $this->buyin,
'fee' => $this->fee,
'game_table' => $this->event_game_table?->title,
'content' => googleTranslateExclude($this->content),
'date_start' => $this->date_start?->date_start ?? '' ,
'date_end' => $this->date_start?->date_end ?? '' ,
'description' => $this->description 

        ];
    }
}
