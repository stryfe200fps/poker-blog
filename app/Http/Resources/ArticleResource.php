<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use App\Models\Glossary;
use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'title' => $this->title,
            'title_tab' => $this->title ?? '',
            'description' => $this->description,
            'categories' => $this->article_categories,
            'content' => articleContentFormatter($this->customContent),
            'slug' => $this->slug,
            'tags' => $this->tags,
            'date' => Carbon::parse($this->published_date)->toFormattedDateString(),
            'formattedDate' => Carbon::parse($this->published_date)->diffForHumans(),
            'image_set' => $this->allMedia(),
            $this->mergeWhen($this->author !== null, [
                'author' => new AuthorResource($this->author),
            ]),
        ];
    }
}
