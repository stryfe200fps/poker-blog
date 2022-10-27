<?php

use App\Models\Article;
use App\Models\ArticleAuthor;
use App\Models\ArticleCategory;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;

uses(RefreshDatabase::class);

// test('article is working', function () {
//     $response = $this->get('api/articles');
//     $response->assertStatus(200);
// });

it('cannot create articles if unauthenticated', function () {
    $this->post('admin/article/', [
        'name' => 'adrian',
    ])->assertStatus(302);
});

it('can insert article if authenticated', function () {
    superAdminAuthenticate();

    $this->get('admin/article/create')->assertStatus(200);

    $data = Article::factory()->make([
        'title' => 'Things I do',
        'article_categories' => collect(ArticleCategory::factory()->times(2)->create())->pluck('id')->toArray(),
    ])->attributesToArray();

    $datas = $this->post('admin/article', $data);
    $this->assertDatabaseHas('articles', ['title' => 'Things I do',
    ]);
});

it('can update article if authenticated', function () {
    superAdminAuthenticate();

    $article = Article::factory()->create();

    $this->get('admin/article/'.$article->id.'/edit')->assertStatus(200);

    $data = Article::factory()->make([
        'id' => $article->id,
        'title' => 'things I hate',
        'article_categories' => collect(ArticleCategory::factory()->times(2)->create())->pluck('id')->toArray(),
    ])->attributesToArray();

    // $data = [
    //     'title' => 'things I hate',
    //     'description' => 'description',
    //     'body' => 'body',
    //     'published_date' => '2020-04-17',
    //     'article_author_id' => ArticleAuthor::factory()->create()->id,
    // ];

    $datas = $this->put('admin/article/update', $data);
    $this->assertDatabaseHas('articles', ['title' => 'things I hate']);
    $this->assertDatabaseCount('articles', 1);
});

it('can delete article if authenticated', function () {
    $u = User::factory()->create();
    $role = Role::create([
        'name' => 'super-admin',
    ]);

    $user = $this->actingAs(User::factory()->create(), 'web');
    backpack_user()->assignRole('super-admin');
    $article = Article::factory()->create();
    $this->get('admin/article')->assertStatus(200);
    $datas = $this->delete('admin/article/1');
});
