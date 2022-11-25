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
        User::truncate();
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
            MediaReportingSeeder::class
        ]);

       $country = Country::where('name', 'Taiwan, Province of China')->first();
       $country->name = 'Taiwan';
       $country->save();

       $country = Country::where('name', 'Korea, Republic of')->first();
       $country->name = 'South Korea';
       $country->save();

       $event = Event::factory()->create();
       $level = Level::factory()->create([
        'event_id' => $event->id
       ]);

       $days = Day::factory()->times(3)->create([
        'event_id' => $event->id
       ]);


       EventReport::factory()->times(5)->create([
            'day_id' => $days[0]->id,
            'level_id' => $level->id
       ]);

       Article::factory()->create();
    }
}
