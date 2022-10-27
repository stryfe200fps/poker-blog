<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class LOFApiEventReportsResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'slug' => $this->slug,
            'title' => $this->title,
            'content' => $this->content,
            'date_published' => $this->date_added,
            'date_for_humans' => Carbon::parse($this->date_added)->diffForHumans(),
            'main_image' => $this->getFirstMediaUrl('event-report', 'main-image'),
            'main_thumb' => $this->getFirstMediaUrl('event-report', 'main-thumb'),
            'caption' => $this->image_caption,
            'theme' => $this->image_theme?->image,
            'type' => $this->type,
            'level' => new LevelResource($this->level),
            'author' => new AuthorResource($this->article_author),
            'event_chips' => EventChipsResource::collection($this->event_chips),
        ];
    }
}
