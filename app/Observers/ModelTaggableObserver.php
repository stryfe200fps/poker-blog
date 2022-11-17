<?php

namespace App\Observers;

use App\Models\Tag;
use Illuminate\Support\Str;
use App\Services\ImageService;
use Spatie\LaravelImageOptimizer\Facades\ImageOptimizer;

class ModelTaggableObserver
{
    public $afterCommit = true;

    public function saved($model) {
    $tags = request()->get('fake_tags');
    $tagIds = [];
    foreach (explode(',', $tags) as $tag)  {

        if ($tag === '')
            continue;

        $tagSlug = Str::slug($tag);
        $countTag = Tag::where('slug', $tagSlug)->count();

        if ($countTag) {
           $tag = Tag::where('slug', $tagSlug)->first();
           $tagIds[] = $tag->id;
        } else {
           $createTag = Tag::create([
                'title' => $tag,
                'slug' => $tagSlug
           ]);
           $tagIds[] = $createTag->id;
        }
    }

    $model->tags()->sync($tagIds);
}
    
}
