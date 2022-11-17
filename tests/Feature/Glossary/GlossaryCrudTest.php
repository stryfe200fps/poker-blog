<?php


use Illuminate\Foundation\Testing\RefreshDatabase;
uses(RefreshDatabase::class);

$route = 'glossary';
$model = 'Glossary';

it("cannot create $route if unauthenticated", fn () => 
    $this->post("admin/$route/", [
        'title' => 'adrian',
    ])->assertStatus(302)
);

it("can insert $route", fn () =>
    insert($route, 
    $glossary = getModel($model)->factory()->make([
        'word' => 'Things I do'
    ])
    ->attributesToArray())
    ->assertDatabaseHas(getModel($model)->getTable(), $glossary)
);

it("can update $route", fn () =>
    update('glossary', $model, 
    $glossary = getModel($model)->factory()->make([
        'word' => 'Things I do'
    ])->attributesToArray())
    ->assertDatabaseHas(getModel($model)->getTable(), $glossary)
);

it("can delete $route if authenticated", fn ()  =>
    delete('glossary', $model )
);

it("it validates when insert wrong data in $route", fn () =>  
    insert($route, [], 0)
    ->assertSessionHasErrors('word')
);


