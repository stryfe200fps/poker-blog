
<?php

use App\Models\Article;
use App\Models\Tag;




test('limit the related article', function () {
    $articles = Article::factory()->create();
    $articles1 = Article::factory()->create();
    $articles2 = Article::factory()->create();

    $tag = Tag::factory()->create([
        'title' => 'news',
    ]);

    $tag1 = Tag::factory()->create([
        'title' => 'blog',
    ]);

    $articles->tags()->attach($tag);
    $articles->tags()->attach($tag1);

    // dd($articles->tags()->get());
});
