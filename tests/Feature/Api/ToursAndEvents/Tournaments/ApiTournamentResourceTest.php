<?php

use App\Models\Event;
use App\Models\Country;
use function DI\factory;
use App\Models\Tournament;

use Database\Seeders\CountrySeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;


uses(RefreshDatabase::class);

test('lof tournamnet api works', function () {



    $this->withExceptionHandling();
    $this->seed(CountrySeeder::class);

    $countrySeeder = Country::inRandomOrder()->first();


    $event = Event::factory()->create();

    // dd(Tournament::all());
    // dd($tournamentApi)


    $tournamentApi = $this->get('api/tournaments?status=live');
    $tournamentApi->assertStatus(200);

});
