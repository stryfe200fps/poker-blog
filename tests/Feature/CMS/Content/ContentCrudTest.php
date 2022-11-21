<?php

use App\Models\Page;
use Illuminate\Foundation\Testing\RefreshDatabase;
uses(RefreshDatabase::class);

$route = 'content';
$model = 'Content';

it("cannot create $route if unauthenticated", fn () => 
    $this->post("admin/$route/", [
        'type' => 'adrian',
    ])->assertStatus(302)
);

it("can insert $route", fn () =>
    insert($route, 
    $game = getModel($model)->factory()->make([
        'type' => 'Things I do',
    ])
    ->attributesToArray())
    ->assertDatabaseHas(getModel($model)->getTable(), $game)
);

it("can update $route", fn () =>
    update($route, $model, 
    $game = getModel($model)->factory()->make([
        'type' => 'Things I do'
    ])->attributesToArray())
    ->assertDatabaseHas(getModel($model)->getTable(), $game)
);

it("can delete $route if authenticated", fn ()  =>
    delete($route, $model )
);

it("it validates when insert wrong data in $route", fn () =>  
    insert($route, [], 0)
    ->assertSessionHasErrors('type')
);
