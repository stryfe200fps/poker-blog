<?php

use App\Models\ArticleCategory;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;

uses(RefreshDatabase::class);

test('article is working', function () {
    $response = $this->get('api/articles');
    $response->assertStatus(200);
});

it('cannot create articles if unauthenticated', function () {
    $this->post('admin/article-category/', [
        'name' => 'adrian',
    ])->assertStatus(302);
});

it('can insert article if authenticated', function () {
    $u = User::factory()->create();
    $role = Role::create([
        'name' => 'super-admin',
    ]);

    $user = $this->actingAs(User::factory()->create(), 'web');

    backpack_user()->assignRole('super-admin');

    $this->get('admin/article-category/create')->assertStatus(200);

    $data = [
        'title' => 'Things I do',
    ];

    $datas = $this->post('admin/article-category', $data);
    $this->assertDatabaseHas('article_categories', ['title' => 'Things I do',
    ]);
});

it('can update article if authenticated', function () {
    $u = User::factory()->create();
    $role = Role::create([
        'name' => 'super-admin',
    ]);

    $user = $this->actingAs(User::factory()->create(), 'web');

    backpack_user()->assignRole('super-admin');

    $category = ArticleCategory::factory()->create();

    $this->get('admin/article-category/'.$category->id.'/edit')->assertStatus(200);

    $data = [
        'id' => $category->id,
        'title' => 'things I hate',
    ];

    $datas = $this->put('admin/article-category/update', $data);
    $this->assertDatabaseHas('article_categories', ['title' => 'things I hate',
    ]);
    $this->assertDatabaseCount('article_categories', 1);
});

it('can delete article if authenticated', function () {
    $u = User::factory()->create();
    $role = Role::create([
        'name' => 'super-admin',
    ]);

    $user = $this->actingAs(User::factory()->create(), 'web');
    backpack_user()->assignRole('super-admin');
    $article = ArticleCategory::factory()->create();
    $this->get('admin/article-category')->assertStatus(200);
    $datas = $this->delete('admin/article-category/1');
});
