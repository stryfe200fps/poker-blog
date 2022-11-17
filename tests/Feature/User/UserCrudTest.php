
<?php


use Illuminate\Foundation\Testing\RefreshDatabase;
uses(RefreshDatabase::class);

$route = 'user';
$model = 'User';

it("cannot create $route if unauthenticated", fn () => 
    $this->post("admin/$route/", [
        'email' => 'a@yahoo.com',
    ])->assertStatus(302)
);

it("can insert $route", fn () =>
    insert($route, 
    $entity = getModel($model)->factory()->make([
        'email' => 'a@yahoo.com',
        'password' => bcrypt('Adichan')
    ])
    ->attributesToArray())
    // ->assertDatabaseHas(getModel($model)->getTable(), array_merge( $entity, ['password' => bcrypt('Adichan')]) )
);

it("can update $route", fn () =>
    update($route, $model, 
    $game = getModel($model)->factory()->make([
        'email' => 'a@yahoo.com'
    ])->attributesToArray())
    ->assertDatabaseHas(getModel($model)->getTable(), $game)
);

it("can delete $route if authenticated", fn ()  =>
    delete($route, $model )
);

it("it validates when insert wrong data in $route", fn () =>  
    insert($route, [], 0)
    ->assertSessionHasErrors('email')
);



