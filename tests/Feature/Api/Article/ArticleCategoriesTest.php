<?php

use App\Models\ArticleCategory;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;

uses(RefreshDatabase::class);

it('cannot create articles if unauthenticated', function () {
    $this->post('admin/article-category/', [
        'name' => 'adrian',
    ])->assertStatus(302);
});

it('can insert article if authenticated', function () {

    superAdminAuthenticate();

    $this->get('admin/article-category/create')->assertStatus(200);

    $data = [
        'title' => 'Things I do',
    ];

    $datas = $this->post('admin/article-category', $data);
    $this->assertDatabaseHas('article_categories', ['title' => 'Things I do',
    ]);
});

it('can update article category if authenticated', function () {

    superAdminAuthenticate();

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
    superAdminAuthenticate();
    
    $article = ArticleCategory::factory()->create();
    $this->get('admin/article-category')->assertStatus(200);
    $datas = $this->delete('admin/article-category/1');
});
