<?php

use App\Models\Country;
use App\Models\Event;
use App\Models\Tournament;
use Database\Seeders\CountrySeeder;

test('lof tournamnet api works', function () {


  $this->seed(CountrySeeder::class);


  $countrySeeder = Country::inRandomOrder()->first();



  $tournament = Tournament::factory()->create([
    'timezone' => 'Asia/Manila' ,
    'country_id' => $countrySeeder->id
  ]);

  $event = Event::factory()->create([

    'tournament_id' => $tournament->id
  ]);
  
 $tournamentApi = $this->get('api/lof-tournament');
 $tournamentApi->assertStatus(200);


//  dd($tournamentApi->json());




});