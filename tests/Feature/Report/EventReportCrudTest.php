<?php

use App\Models\Day;
use App\Models\Level;
use Illuminate\Foundation\Testing\RefreshDatabase;

use function DI\factory;

uses(RefreshDatabase::class);

$route = 'report';
$model = 'EventReport';

it("cannot create $route if unauthenticated", fn () => 
    $this->post("admin/$route/", [
        'title' => 'adrian',
    ])->assertStatus(302)
);

it("can insert $route", fn () =>
    insert($route, 
    $game = getModel($model)->factory()->make([
        'title' => 'Things I do',
        ])
    ->attributesToArray(), true, [
        'day' => $game['day_id'],
        'event' => Day::find($game['day_id'])->event_id,
        ])
    ->assertDatabaseHas(getModel($model)->getTable(), $game)
);

it("can update $route", fn () =>
    update($route, $model, 
    $game = getModel($model)->factory()->make([
        'title' => 'Things I do'
    ])->attributesToArray(), 
    [
        'day' => $game['day_id'],
        'event' => Day::find($game['day_id'])->event_id,
    ])
    ->assertDatabaseHas(getModel($model)->getTable(), $game)
);

it("can delete $route if authenticated", fn ()  =>
    delete($route, $model )
);

// it("it validates when insert wrong data in $route", fn () =>  
//     insert($route, [], 0)
//     ->assertSessionHasErrors('title')
// );

