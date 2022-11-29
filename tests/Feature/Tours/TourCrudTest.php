<?php

use App\Models\Tour;
use App\Models\User;
use App\Models\Article;
use Spatie\Permission\Models\Role;




test('tour index  is working', function () {
    $response = $this->get('api/tours');
    $response->assertStatus(200);
});

it('cannot create tour if unauthenticated', function () {
    $this->post('admin/poker-tour/', [
        'name' => 'adrian',
    ])->assertStatus(302);
});


it('can insert tour if authenticated', function () {
    superAdminAuthenticate();

    $this->get('admin/poker-tour/create')->assertStatus(200);

    $tourCreate = Tour::factory()->make([
        'title' => 'Things I do',
    ]);

     $this->post('/admin/poker-tour', $tourCreate->attributesToArray());

    $this->assertDatabaseHas('tours', ['title' => 'Things I do']);
});


it('can update tours if authenticated', function () {
    $this->withExceptionHandling();
    superAdminAuthenticate();
    $tour = Tour::factory()->create();

    $this->get('admin/poker-tour/'.$tour->id.'/edit')->assertStatus(200);


    $tourUpdate = Tour::factory()->make([
        'id' => $tour->id,
        'title' => 'Things I do',
    ]);

    $this->put('/admin/poker-tour/update', $tourUpdate->attributesToArray());

    $this->assertDatabaseHas('tours', ['title' => 'Things I do',
    ]);

    $this->assertDatabaseCount('tours', 1);
});


it('can delete tours if authenticated', function () {

    $this->withoutExceptionHandling();

    superAdminAuthenticate();

    $tour = Tour::factory()->create();
    $this->delete('admin/poker-tour/'.$tour->id);

    expect(Tour::all()->count())->toBe(0);
});

it('it validates when insert wrong data', function () {
    superAdminAuthenticate();

    $this->get('admin/poker-tour/create')->assertStatus(200);
    $postedEmpty = $this->post('/admin/poker-tour', []);

    $postedEmpty->assertSessionHasErrors('title');
    $postedEmpty->assertSessionHasErrors('description');
});

