<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class LOFApiEventReportsResource extends JsonResource
{
    public function toArray($request)
    {


        // $img = $this->getMedia('event-report');
        // $images =   is_countable($img) && count($img) > 0 ? new ImageResource( $this->getMedia('event-report')[0]) : '' ;

        return [
            'id' => $this->id,
            'title' => googleTranslateExclude($this->title)[0] ?? '' ,
            'title_tab' => $this->title ?? '', 
            'content' => googleTranslateExclude($this->content),
            'published_date' => Carbon::parse($this->published_date)->toDayDateTimeString(),
            'realtime_published_date' =>  $this->handleDatePublish($this->published_date),
            'date_for_humans' => Carbon::parse($this->published_date)->setTimezone($this->event->tournament->word_timezone)->diffForHumans(),
            'image_set' => $this->getMediaWithCaching(),
            'caption' => $this->image_caption,
            'theme' => $this->image_theme?->image,
            'type' => $this->type,
            'level' => new LevelResource($this->level),
            'author' => new AuthorResource($this->author),
            'event_chips' => EventChipsResource::collection($this->event_chips),
        ];
    }
}
