<?php

use App\Models\Article;
use App\Models\MenuItem;
use Backpack\Settings\app\Models\Setting;
use Laravel\Dusk\Browser;

use Illuminate\Foundation\Testing\RefreshDatabase;
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

    $browser->screenshot('home');
    });
});