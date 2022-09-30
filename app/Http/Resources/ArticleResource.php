<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
{
    public function toArray($request)
    {

        // dd($this->getFirstMedia('article', 'feature_image')->getUrl());
        return [
            'title' => $this->title,
            'description' => $this->description,
            'categories' => $this->article_categories,
            'body' => $this->body,
            'slug' => $this->slug,
            'tags' => $this->article_tags,
            'date' => Carbon::parse($this->published_date)->toFormattedDateString(),
            'formattedDate' => Carbon::parse($this->date_added)->diffForHumans(),
            'main_image' => $this->getFirstMediaUrl('article', 'main-image'),
            'thumb_image' => $this->getFirstMediaUrl('article', 'main-thumb'),
            'author' => $this->article_author->first_name.' '.$this->article_author->last_name,
        ];
    }
}
