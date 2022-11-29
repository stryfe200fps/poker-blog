<?php





$route = 'banner';
$model = 'Banner';

it("cannot create $route if unauthenticated", fn () => 
    $this->post("admin/$route/", [
        'name' => 'adrian',
    ])->assertStatus(302)
);

it("can insert $route", fn () =>
    insert($route, 
    array_merge( $game = getModel($model)->factory()->make([
        'name' => 'Things I do',
    ])
    ->attributesToArray(), [ 'image' => 'image.jpg' ] ))
    ->assertDatabaseHas(getModel($model)->getTable(), $game)
);

it("can update $route", fn () =>
    update($route, $model, 
    $game = getModel($model)->factory()->make([
        'name' => 'Things I do',
    ])->attributesToArray())
    ->assertDatabaseHas(getModel($model)->getTable(), $game)
);

it("can delete $route if authenticated", fn ()  =>
    delete($route, $model )
);

it("it validates when insert wrong data in $route", fn () =>  
    insert($route, [], 0)
    ->assertSessionHasErrors('name')
);
