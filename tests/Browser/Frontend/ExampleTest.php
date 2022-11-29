<?php

use App\Models\Event;
use App\Models\Article;
use App\Models\MenuItem;
use function DI\factory;
use Laravel\Dusk\Browser;
use App\Models\EventReport;

use Backpack\Settings\app\Models\Setting;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

// uses(DatabaseMigrations::class);
uses(RefreshDatabase::class);
 
 
it('has homepage', function () {
    MenuItem::factory()->create([
        'name' => 'NEWS',
        'link'  => 'NEWS'
    ]);

    Article::factory()->create([
        'title' => 'Adi content'
    ]);

    $this->browse(function (Browser $browser) {
    $visit = $browser->visit('/');
    $visit->waitUntilMissingText('Loading...');
    $visit->assertSee('NEWS');
    sleep(5);
    // $visit->assertSee('dusk event');
    $browser->screenshot('home');
    });
});