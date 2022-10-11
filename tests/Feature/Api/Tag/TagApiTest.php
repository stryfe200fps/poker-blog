
<?php

use App\Models\Tag;
use App\Models\User;
use App\Models\Article;
use App\Models\ArticleAuthor;
use App\Models\ArticleCategory;
use App\Models\Event;
use App\Models\EventReport;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Query\Expression;
use Illuminate\Testing\Fluent\AssertableJson;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('article with tags ', function () {
    $this->withExceptionHandling();

    $article = Article::factory()->create([
        'title' => 'adrian blog'
    ]);

    $tag1 = Tag::factory()->create([
        'title' => 'news'
    ]);

    $tag2 = Tag::factory()->create([
        'title' => 'blog'
    ]);

    $article->tags()->attach($tag1);
    $article->tags()->attach($tag2);

    $json = $this->json('get', "/api/tag/articles/{$tag1->slug}");

    $json
    ->assertJsonPath(
        'data.0.title' , 'adrian blog'
    );

});


test('live report with tags ', function () {
    $this->withExceptionHandling();

    $event = Event::factory()->create();
    $report = EventReport::factory()->create([
        'title' => 'adrian live report now',
        'event_id' => $event->id
    ]);

    $tag1 = Tag::factory()->create([
        'title' => 'news'
    ]);

    $tag2 = Tag::factory()->create([
        'title' => 'blog'
    ]);

    $report->tags()->attach($tag1);
    $report->tags()->attach($tag2);

    $json = $this->json('get', "/api/tag/reports/{$tag1->slug}");

    $json
    ->assertJsonPath(
        'data.0.title' , 'adrian live report now'
    );

});