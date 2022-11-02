<?php

namespace App\Http\Resources\LiveReport;

use App\Http\Resources\EventChipsResource;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class LiveReportResource extends JsonResource
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
            'title' => $this->title,
            'description' => $this->content,
            'event' => $this->poker_event,
            'author' => $this->author,
            'date' => Carbon::parse($this->published_date)->toFormattedDateString(),
            'image' => $this->getFirstMediaUrl('logo', 'main-image'),
            'caption' => $this->image_caption,
            'theme' => $this->image_theme,
            'day' => $this->day,
            'level' => $this->level,
            // 'players' => EventChipsResource::collection($this->liveReportPlayers),
        ];
    }
}
