<?php

use App\Models\Article;
use App\Models\ArticleAuthor;
use App\Models\ArticleCategory;
use App\Models\Tournament;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;

uses(RefreshDatabase::class);

// test('article is working', function () {
//     $response = $this->get('api/articles');
//     $response->assertStatus(200);
// });

it('cannot create tournament if unauthenticated', function () {
    $this->post('admin/poker-tournament/', [
        'name' => 'adrian',
    ])->assertStatus(302);
});

it('can insert tournament if authenticated', function () {


    superAdminAuthenticate();

    $this->get('admin/poker-tournament/create')->assertStatus(200);

    $tournamentFactory = Tournament::factory()->make([
        'title' => 'my tournament'
    ]);

    $this->post('admin/poker-tournament', $tournamentFactory->attributesToArray());
    $this->assertDatabaseHas('tournaments', ['title' => 'my tournament']);
});

it('can update article if authenticated', function () {

    superAdminAuthenticate();

    $tournament = Tournament::factory()->create();


    $alteredTournament = Tournament::factory()->make([
        'title' => 'altered tournament',
        'id' => $tournament->id
    ]);

    $this->get('admin/poker-tournament/'.$tournament->id.'/edit')->assertStatus(200);

    $this->put('admin/poker-tournament/update', $alteredTournament->attributesToArray());

    $this->assertDatabaseHas('tournaments', ['title' => 'altered tournament']);
    $this->assertDatabaseCount('tournaments', 1);
});

it('can delete tournament if authenticated', function () {

    superAdminAuthenticate();

    Tournament::factory()->create();

    $this->get('admin/poker-tournament')->assertStatus(200);
    $this->delete('admin/poker-tournament/1');
});
