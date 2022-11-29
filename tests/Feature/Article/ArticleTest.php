<?php

use App\Models\Article;
use App\Models\Author;
use App\Models\ArticleCategory;
use App\Models\User;

use Spatie\Permission\Models\Role;


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
    $this->withoutExceptionHandling();
    superAdminAuthenticate();

    $this->get('admin/article/create')->assertStatus(200);

    $data = Article::factory()->make([
        'title' => 'Things I do',
        'main_content' => 'main content',
        'article_categories' => collect(ArticleCategory::factory()->times(2)->create())->pluck('id')->toArray(),
    ])->attributesToArray();


    $datas = $this->post('admin/article', $data);
    $this->assertDatabaseHas('articles', [
        'title' => 'Things I do',
    ]);
});

it('can update article if authenticated', function () {
    superAdminAuthenticate();

    $article = Article::factory()->create();

    $this->get('admin/article/' . $article->id . '/edit')->assertStatus(200);

    $data = Article::factory()->make([
        'id' => $article->id,
        'title' => 'things I hate',
        'main_content' => 'main content',
        'article_categories' => collect(ArticleCategory::factory()->times(2)->create())->pluck('id')->toArray(),
    ])->attributesToArray();

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
