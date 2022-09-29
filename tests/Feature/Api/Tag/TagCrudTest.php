<?php

use App\Models\Article;
use App\Models\ArticleAuthor;
use App\Models\ArticleCategory;
use App\Models\Tag;
use App\Models\Tournament;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;

uses(RefreshDatabase::class);

// test('events is working', function () {
//     $response = $this->get('/api/events');
//     $response->assertStatus(200);
// });

it('cannot create tags if unauthenticated', function () {
    $this->post('admin/tag/', [
        'title' => 'adrian',
    ])->assertStatus(302);
});

it('can insert tag if authenticated', function () {
    $u = User::factory()->create();
    $role = Role::create([
        'name' => 'super-admin',
    ]);

    $user = $this->actingAs(User::factory()->create(), 'web');

    backpack_user()->assignRole('super-admin');

    $this->get('admin/tag/create')->assertStatus(200);

    $data = [
        'title' => 'news',
    ];

    $datas = $this->post('/admin/tag', $data);

    $this->assertDatabaseHas('tags', ['title' => 'news',
    ]);

    // $datas->assertSessionHasErrors('date_start');
    // $datas->assertSessionHasErrors('end_date');
});


it('can update tags if authenticated', function () {
  $u = User::factory()->create();
  $role = Role::create([
      'name' => 'super-admin',
  ]);

  $user = $this->actingAs(User::factory()->create(), 'web');

  backpack_user()->assignRole('super-admin');

  $tagData = Tag::factory()->create([
    'title' => 'news'
  ]);

  $this->get('admin/tag/'.$tagData->id.'/edit')->assertStatus(200);

  $data = [
      'id' => $tagData->id,
      'title' => 'blog',
  ];

  $datas = $this->put('admin/tag/update', $data);
  $this->assertDatabaseHas('tags', ['title' => 'blog',
  ]);

  expect($tagData->title === $data['title'])->toBeFalse();
  $this->assertDatabaseCount('tags', 1);
});

it('can delete article if authenticated', function () {
  $u = User::factory()->create();
  $role = Role::create([
      'name' => 'super-admin',
  ]);

  $user = $this->actingAs(User::factory()->create(), 'web');

  backpack_user()->assignRole('super-admin');
  Tag::factory()->create();
  $this->get('admin/tag')->assertStatus(200);
  $datas = $this->delete('admin/tag/1');
});
