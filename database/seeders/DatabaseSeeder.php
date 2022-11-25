<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Article;
use Carbon\Carbon;
use App\Models\Day;
use App\Models\User;
use App\Models\Event;
use App\Models\Country;
use App\Models\EventReport;
use App\Models\Level;
use Illuminate\Database\Seeder;
use App\Models\MediaReportingCategory;
use App\Models\Tournament;
use App\Services\ImageService;
use Backpack\PermissionManager\app\Models\Role;

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
            MenuItemSeeder::class
        ]);

       $country = Country::where('name', 'Taiwan, Province of China')->first();
       $country->name = 'Taiwan';
       $country->save();

       $country = Country::where('name', 'Korea, Republic of')->first();
       $country->name = 'South Korea';
       $country->save();

       $tournament = Tournament::factory()->create();

       $event = Event::factory()->create([
        'tournament_id' => $tournament->id
       ]);


        $link = config('app.url'). '/default_og-image.png';
       $imageService = new ImageService($link, $tournament);
       $imageService->imageUpload();

       $level = Level::factory()->create([
        'event_id' => $event->id
       ]);

       $days = Day::factory()->times(3)->create([
        'event_id' => $event->id
       ]);

       EventReport::factory()->times(3)->create([
            'day_id' => $days[0]->id,
            'level_id' => $level->id
       ]);


    $all =    Article::factory()->times(5)->create();

    foreach ($all as $article) {
        $link = config('app.url'). '/default_og-image.png';
       $imageService = new ImageService($link , $article);
       $imageService->imageUpload();
    }


    }
}
