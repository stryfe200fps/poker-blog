<?php

use App\Models\Event;
use App\Models\Article;
use App\Models\Day;
use App\Models\MenuItem;
use function DI\factory;
use Laravel\Dusk\Browser;
use App\Models\EventReport;

use Backpack\Settings\app\Models\Setting;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\DB;

uses(RefreshDatabase::class);
 
it('has homepage', function () {

    $article = Article::factory()->create([
        'title' => 'Adi content'
    ]);

    $event = Event::factory()->create([
        'title' => 'Adi event'
    ]);

    $day = Day::factory()->create([
        'event_id' => $event->id
    ]);

    $eventReport = EventReport::factory()->create([
        'day_id' => $day->id
    ]);

    $this->browse(function (Browser $browser) {
    $visit = $browser->visit('/');
    $visit->waitUntilMissingText('Loading...');
    $visit->assertSee('NEWS');
    sleep(5);
    $visit->assertSee('Adi content');
    $visit->assertSee('ADI EVENT');
    $visit->assertSee('LIVE NOW');
    $browser->screenshot('home');
    });

    \Artisan::call('migrate:fresh');
    \Artisan::call('db:seed');
});