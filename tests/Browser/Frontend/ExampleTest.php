<?php

use App\Models\Day;
use App\Models\Event;
use App\Models\Level;
use App\Models\Article;
use App\Models\EventChip;
use App\Models\EventPayout;
use App\Models\MenuItem;
use function DI\factory;
use Laravel\Dusk\Browser;
use App\Models\EventReport;
use App\Models\Player;
use App\Models\Tournament;
use App\Services\ImageService;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\DB;
use Backpack\Settings\app\Models\Setting;

use Illuminate\Foundation\Testing\DatabaseMigrations;

it('website simulation', function () {

    $tournament = Tournament::factory()->create([
        'title' => 'Adi Tournament'

    ]);

    $article = Article::factory()->create([
        'title' => 'Adi content'
    ]);

    $event = Event::factory()->create([
        'title' => 'Adi event',
        'tournament_id' => $tournament->id
    ]);

    $day = Day::factory()->create([
        'event_id' => $event->id
    ]);

    $level = Level::factory()->create([
        'event_id' => $event->id
    ]);

    $eventReport = EventReport::factory()->create([
        'level_id' => $level->id,
        'title' => 'Adi report title',
        'content' => 'adi report content',
        'day_id' => $day->id
    ]);

    // $link = config('app.url') . '/default_og-image.png';
    $image = new ImageService('https://wp.lifeofpoker.com/wp-content/uploads/2022/08/Trophy-Main-Event-APPT-2022-1-1024x682.jpg', $eventReport);
    $image->imageUpload();

    $player = Player::factory()->create([
        'name' => 'Adrian Radores'
    ]);

    EventChip::factory()->create([
        'player_id' => $player->id,
        'event_report_id' => $eventReport->id,
        'day_id' => $day->id
    ]);

    EventChip::factory()->create([
        'player_id' => $player->id,
        'event_report_id' => $eventReport->id,
        'day_id' => $day->id,
        'is_whatsapp' => true
    ]);

    $payouts = EventPayout::factory()->create([
        'event_id' => $event->id,
        'player_id' => $player->id
    ]);

    $this->browse(function (Browser $browser) use ($level, $day) {
        $visit = $browser->visit('/');

        $visit->waitForText('Adi content');
        $visit->assertSee('NEWS');
        $visit->assertSee('Adi content');
        $visit->assertSee('LIVE NOW');
        $browser->screenshot('home');

        $liveReport = $browser->visit('/live-reporting');
        $liveReport->waitForText('Adi Event');
        $liveReport->assertSee('Adi Event');
        $browser->screenshot('live-report');

        $liveReport->click('.tour-wrapper .post-content .link--custom');

        EventReport::factory()->create([
            'level_id' => $level->id,
            'title' => 'Adi popup',
            'content' => 'Adi popup',
            'day_id' => $day->id
        ]);

        $liveReport->waitUntilMissingText('Loading...');
        $liveReport->waitForText('Adi report title');
        $liveReport->assertSee('Adi report title');

        $liveReport->waitForText('adi report content');
        $liveReport->assertSee('adi report content');


        $liveReport->waitForText('Adi popup');
        $liveReport->assertSee('Adi popup');
        $liveReport->screenshot('event/event');

        $liveReport->clickLink('CHIP COUNTS');
        $liveReport->waitUntilMissingText('Loading...');
        $liveReport->waitForText('Adrian Radores');

        $liveReport->pause(1000);
        $liveReport->assertSee('Adrian Radores');
        $liveReport->screenshot('event/chips');

        $liveReport->clickLink('#WHATSAPP');

        $liveReport->waitUntilMissingText('Loading...');

        $liveReport->pause(1000);
        $liveReport->waitForText('Adrian Radores');
        $liveReport->assertSee('Adrian Radores');
        $liveReport->screenshot('event/whatsapp');

        $liveReport->clickLink('GALLERY');
        $liveReport->waitUntilMissingText('Loading...');
        $liveReport->pause(1000);
        $liveReport->assertVisible('#my-gallery');
        $liveReport->screenshot('event/gallery');

        $liveReport->clickLink('PAYOUTS');

        $liveReport->waitUntilMissingText('Loading...');
        $liveReport->waitForText('Adrian Radores');
        $liveReport->assertSee('Adrian Radores');
        $liveReport->screenshot('event/payouts');
    });
});


test('can view article', function () {

    $this->browse(function (Browser $browser) {

        $articles = Article::factory()->times(10)->create();

        $visit = $browser->visit('/news');
        $visit->waitForText($articles[0]->title);

        $visit->assertSee($articles[0]->title);
        $visit->assertSee($articles[4]->title);

        $visit->screenshot('articles/latest-news');

        $visit = $browser->visit('/news/2022/10/' . $articles[0]->slug);

        $visit->waitForText($articles[0]->title);
        $visit->assertSee($articles[0]->title);

        $visit->screenshot('articles/show');
    });
});
