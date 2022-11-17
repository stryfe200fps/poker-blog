<?php

use App\Models\Article;
use App\Models\Tournament;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Faker\faker;

uses(RefreshDatabase::class);

// test('article is working', function () {
//     $response = $this->get('api/articles');
//     $response->assertStatus(200);
// });

it('cannot create tournament if unauthenticated', function () {
    $this->post('admin/series/', [
        'name' => 'adrian',
    ])->assertStatus(302);
});

it('can insert tournament if authenticated', function () {
    superAdminAuthenticate();

    $this->get('admin/series/create')->assertStatus(200);
    // dd(faker()->dateTimeThisCentury());

    $tournamentFactory = Tournament::factory()->make([
        'title' => 'my tournament',
        'date_start' => Carbon::parse(faker()->dateTimeThisCentury())->toString(),
        'date_end' => Carbon::parse(faker()->dateTimeThisCentury())->toString(),

    ]);

    $this->post('admin/series', $tournamentFactory->attributesToArray());
    $this->assertDatabaseHas('tournaments', ['title' => 'my tournament']);
});

it('can update article if authenticated', function () {
    superAdminAuthenticate();

    $tournament = Tournament::factory()->create();

    $alteredTournament = Tournament::factory()->make([
        'title' => 'altered tournament',
        'id' => $tournament->id,
        'date_start' => Carbon::parse(faker()->dateTimeThisCentury())->toString(),
        'date_end' => Carbon::parse(faker()->dateTimeThisCentury())->toString(),

    ]);

    $this->get('admin/series/'.$tournament->id.'/edit')->assertStatus(200);

    $this->put('admin/series/update', $alteredTournament->attributesToArray());

    $this->assertDatabaseHas('tournaments', ['title' => 'altered tournament']);
    $this->assertDatabaseCount('tournaments', 1);
});



it('can delete series if authenticated', function () {

    $this->withoutExceptionHandling();

    superAdminAuthenticate();

    $series = Tournament::factory()->create();
    $this->delete('admin/series/'.$series->id);

    expect(Tournament::all()->count())->toBe(0);
});


it('it validates when insert wrong data', function () {
    superAdminAuthenticate();

    $this->get('admin/series/create')->assertStatus(200);
    $postedEmpty = $this->post('/admin/series', []);

    $postedEmpty->assertSessionHasErrors('title');
    $postedEmpty->assertSessionHasErrors('description');
});
