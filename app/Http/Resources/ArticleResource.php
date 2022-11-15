<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use App\Models\Glossary;
use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
{
    public function toArray($request)
    {
        // dd($this->firstContent);
        return [
            'title' => googleTranslateExclude($this->title)[0],
            'title_tab' => $this->title ?? '',
            'description' => $this->description,
            'categories' => $this->article_categories,
            'main_content' => googleTranslateExclude($this->firstContent),
            'content' =>  $this->optionalContent,
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
