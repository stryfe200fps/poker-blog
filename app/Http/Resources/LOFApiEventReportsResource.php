<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class LOFApiEventReportsResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => googleTranslateExclude($this->title)[0] ?? '' ,
            'content' => googleTranslateExclude($this->content),
            'published_date' => $this->published_date,
            'date_for_humans' => Carbon::parse($this->published_date)->diffForHumans(),
            'main_image' => $this->getFirstMediaUrl('event-report', 'main-image'),
            'main_thumb' => $this->getFirstMediaUrl('event-report', 'main-thumb'),
            'caption' => $this->image_caption,
            'theme' => $this->image_theme?->image,
            'type' => $this->type,
            'level' => new LevelResource($this->level),
            'author' => new AuthorResource($this->author),
            'event_chips' => EventChipsResource::collection($this->event_chips),
        ];
    }
}
