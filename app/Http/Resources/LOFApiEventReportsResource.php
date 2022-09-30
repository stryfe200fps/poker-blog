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
            'status' => $this->status(),
            'id' => $this->id,
            'date_added' => $this->date_added,
            'title' => $this->title,
            'content' => $this->content,
            'event' => $this->event,
            'author' => $this->article_author,
            'date' => Carbon::parse($this->date_added)->toFormattedDateString(),
            'isFinished' => $this->event->tournament->date_end < Carbon::now(),
            'formattedDate' => Carbon::parse($this->date_added)->diffForHumans(),
            'main_image' => $this->getFirstMediaUrl('event-report', 'main-image'),
            'main_thumb' => $this->getFirstMediaUrl('event-report', 'main-thumb'),
            'caption' => $this->image_caption,
            'theme' => $this->image_theme,
            'day' => $this->day,
            'article_author' => $this->article_author,
            'level' => $this->level,
            'event_chips' => EventChipsResource::collection($this->event_chips),
        ];
    }
}
