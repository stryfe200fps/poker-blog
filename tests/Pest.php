<?php

use Tests\TestCase;
use App\Models\User;
use Tests\DuskTestCase;

use App\Services\ImageService;
use Spatie\Permission\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

/*
|--------------------------------------------------------------------------
| Test Case
|--------------------------------------------------------------------------
|
| The closure you provide to your test functions is always bound to a specific PHPUnit test
| case class. By default, that class is "PHPUnit\Framework\TestCase". Of course, you may
| need to change it using the "uses()" function to bind a different classes or traits.
|
*/

uses(TestCase::class, RefreshDatabase::class)->in('Feature');
uses(DuskTestCase::class, DatabaseMigrations::class)->in('Browser');




/*
|--------------------------------------------------------------------------
| Expectations
|--------------------------------------------------------------------------
|
| When you're writing tests, you often need to check that values meet certain conditions. The
| "expect()" function gives you access to a set of "expectations" methods that you can use
| to assert different things. Of course, you may extend the Expectation API at any time.
|
*/

expect()->extend('toBeOne', function () {
    return $this->toBe(1);
});

/*
|--------------------------------------------------------------------------
| Functions
|--------------------------------------------------------------------------
|
| While Pest is very powerful out-of-the-box, you may have some testing code specific to your
| project that you don't want to repeat in every file. Here you can also expose helpers as
| global functions to help you to reduce the number of lines of code in your test files.
|
*/



function superAdminAuthenticate()
{
    $u = User::factory()->create();
    $role = Role::create([
        'name' => 'super-admin',
    ]);

    $user = test()->actingAs(User::factory()->create(), 'web');
    backpack_user()->assignRole('super-admin');

    return $u;
}

function insert($route, array $attributes, $returnDefault = true, $routeParameters = [])
{
    //authenticate user
    test()->superAdminAuthenticate();
    $test = test()->get("/admin/$route/create?" . http_build_query($routeParameters))->assertStatus(200);
    $post = test()->post("/admin/$route", $attributes);
    if (!$returnDefault)
        return $post;

    return test();
}

function delete($route, string $model)
{

    test()->superAdminAuthenticate();

    $abstractModel = getModel($model);
    $create = $abstractModel->factory()->create();
    test()->delete("admin/$route/$create->id");

    $count = $abstractModel->where('id', $create->id)->count();
    expect($count)->toBe(0);
    return test();
}

function update($route, string $model, array $attributes, $routeParameters = [])
{
    test()->superAdminAuthenticate();

    //create new data
    $create = getModel($model)->factory()->create($attributes);
    $id = $create->id;
    //go to the edit page
    $visit =  test()->get("admin/$route/$id/edit?" . http_build_query($routeParameters))->assertStatus(200);
    //save update
    $test = test()->put("/admin/$route/update", $attributes);

    return test();
}


function getModel(string $model)
{
    return test()->app()->make("App\Models\\$model");
}

function getFileType($value)
{
    return (new \ReflectionClass(get_class($value)))->getShortName();
}


function uploadImage($image, $model)
{
    return (new ImageService($image, $model))->imageUpload();
}

function generateString($length = 100)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }

    return $randomString;
}
