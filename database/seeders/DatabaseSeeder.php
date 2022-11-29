<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Article;
use Carbon\Carbon;
use App\Models\Day;
use App\Models\User;
use App\Models\Event;
use App\Models\Country;
use App\Models\EventChip;
use App\Models\EventPayout;
use App\Models\EventReport;
use App\Models\Level;
use Illuminate\Database\Seeder;
use App\Models\MediaReportingCategory;
use App\Models\Player;
use App\Models\Tournament;
use App\Services\ImageService;
use Backpack\PermissionManager\app\Models\Role;
use Illuminate\Support\Testing\Fakes\EventFake;

use function DI\factory;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        if (app()->environment() !== 'local') { 
            dump('Please change your environment to local');
            return;
        }

        $user = User::factory()->create([
            'name' => 'Adi',
            'email' => 'admin@chanzglobal.com',
            'password' => bcrypt('admin'),
        ]);

        $role = Role::updateOrCreate([
            'name' => 'super-admin',
        ]);

        $author = Role::updateOrCreate([
            'name' => 'author',
        ]);

        $user->assignRole('super-admin');

        $this->call([
            CurrencySeeder::class,
            ArticleCategorySeeder::class,
            CountrySeeder::class,
            MediaReportingCategorySeeder::class,
            MediaReportingSeeder::class,
            SettingDefaultSeeder::class,
            MenuItemSeeder::class,
            PokerRoomSeeder::class
        ]);

       $country = Country::where('name', 'Taiwan, Province of China')->first();
       $country->name = 'Taiwan';
       $country->save();

       $country = Country::where('name', 'Korea, Republic of')->first();
       $country->name = 'South Korea';
       $country->save();

       $this->createEvent('Adrian Radores', 'APT');
       $this->createEvent('Raven Barrogo', 'Mega Stack');


    $all =    Article::factory()->times(3)->create();

    foreach ($all as $article) {
        $this->upload($article);
    }

    }

    public function createEvent($playerName, $eventName)
    {
       $tournament = Tournament::factory()->create([
            'title' => $eventName. ' Championship'
       ]);

       $event = Event::factory()->create([
            'title' => $eventName. ' Event',
            'tournament_id' => $tournament->id
       ]);

       $days = Day::factory()->times(3)->create([
        'event_id' => $event->id
       ]);


        $levels = Level::factory()->times(3)->create([
        'event_id' => $event->id
       ]);

       foreach ($levels as $level) {
        $reports = EventReport::factory()->times(5)->create([
            'level_id' => $level->id,
            'day_id' => $days[0]->id
            ]);
        $reportsInDay2 = EventReport::factory()->times(5)->create([
        'level_id' => $level->id,
        'day_id' => $days[1]->id
       ]);

        $reportsInDay3 = EventReport::factory()->times(5)->create([
        'level_id' => $level->id,
        'day_id' => $days[2]->id
       ]);
       }
     

       $player = Player::factory()->create([
        'name' => $playerName
       ]);

       foreach ($reports as $report) {
        EventChip::factory()->create([
            'event_report_id' => $report->id,
            'player_id' => $player->id,
            'day_id' => $report->day->id,
            'published_date' => $report->published_date
        ]);
       }

        foreach ($reportsInDay2 as $report) {
        EventChip::factory()->create([
            'event_report_id' => $report->id,
            'player_id' => $player->id,
            'day_id' => $report->day->id,
            'published_date' => $report->published_date
        ]);
       }

        foreach ($reportsInDay3 as $report) {
        EventChip::factory()->create([
            'event_report_id' => $report->id,
            'player_id' => $player->id,
            'day_id' => $report->day->id,
            'published_date' => $report->published_date
        ]);
       }

       $this->upload($event);
       $this->upload($tournament);
       $this->addPayouts($event);

    }

    public function addPayouts($event)
    {
        $players = Player::factory()->times(10)->create();
        foreach ($players as $player) {
            EventPayout::factory([
                'event_id'  => $event->id,
                'player_id' => $player->id
                ])->create();
        }
    }


    public function upload($model)
    {
        $link = config('app.url'). '/default_og-image.png';
       $imageService = new ImageService($link , $model);
       $imageService->imageUpload();
    }
}
