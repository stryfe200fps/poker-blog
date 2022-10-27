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
            'title' => $this->title,
            'description' => $this->description,
            'image' => $this->image,
            'tournament' => $this->tournament->title,
            'tournament_slug' => $this->tournament->slug,
            'tour_slug' => $this->tournament->tour->slug,
            'schedule' => $this->schedule,
            'date_start' => $this->scheduleArray($this->schedule, session()->get('timezone'))->first()['date_start'] ?? '',
            'date_end' => $this->scheduleArray($this->schedule, session()->get('timezone'))->last()['date_end'] ?? '',
        ];
    }
}
