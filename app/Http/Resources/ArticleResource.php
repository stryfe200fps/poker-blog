<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use App\Models\Glossary;
use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
{
    public function toArray($request)
    {

        $img = $this->getMedia('article');
        $images =   is_countable($img) && count($img) > 0 ? new ImageResource( $this->getMedia('article')[0]) : '' ;
     
        return [
            'title' => googleTranslateExclude($this->title)[0] ?? '',
            'title_tab' => $this->title ?? '',
            'description' => $this->description,
            'categories' => $this->article_categories,
            'content' => googleTranslateExclude($this->content),
            'slug' => $this->slug,
            'tags' => $this->tags,
            'date' => Carbon::parse($this->published_date)->toFormattedDateString(),
            'formattedDate' => Carbon::parse($this->published_date)->diffForHumans(),
            'image_set' => $images,
            'main_image' => $this->getFirstMediaUrl('article', 'main-image'),
            'thumb_image' => $this->getFirstMediaUrl('article', 'main-thumb'),
            $this->mergeWhen($this->author !== null, [
                'author' => new AuthorResource($this->author),
            ]),
        ];
    }
}
