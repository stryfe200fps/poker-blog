<?php

use App\Models\Country;
use App\Models\Event;
use App\Models\Tournament;
use Database\Seeders\CountrySeeder;

test('lof tournamnet api works', function () {
    $this->withExceptionHandling();
    $this->seed(CountrySeeder::class);

    $countrySeeder = Country::inRandomOrder()->first();

    $event = Event::factory()->create();


    $tournamentApi = $this->get('api/lof-tournament?status=upcoming');
    $tournamentApi->assertStatus(200);

});
