<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Event;
use Illuminate\Database\Seeder;
use Backpack\PermissionManager\app\Models\Role;

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



        $role = Role::create([
            'name' => 'super-admin',
        ]);

        $author = Role::create([
            'name' => 'author',
        ]);



        // backpack_user()->assignRole('super-admin');
        $user->assignRole('super-admin');

        $this->call([
            // CountriesSeeder::class,
            CurrencySeeder::class,
            // ArticleAuthorSeeder::class,
            // LevelSeeder::class,
            ArticleCategorySeeder::class,
            // ArticleSeeder::class,
            CountrySeeder::class,
            // PlayerSeeder::class,
         
            // LiveReportSeeder::class,

        ]);
        $this->call(ArticlesTableSeeder::class);
        $this->call(ArticleAuthorsTableSeeder::class);
        // $this->call(LiveReportEventChipTableSeeder::class);
        // $this->call(EventChipsTableSeeder::class);
        // $this->call(LiveReportsTableSeeder::class);
        // $this->call(MediaTableSeeder::class);
        $this->call(PlayersTableSeeder::class);
        $this->call(ToursTableSeeder::class);
        $this->call(TournamentsTableSeeder::class);
        $this->call(EventsTableSeeder::class);

        // $day1DateStart = Carbon::now();
        // $day1DateEnd = $day1DateStart->addHours(12);
    
        // $day2DateStart = $day1DateEnd->addDay(1);
        // $day2DateEnd = $day2DateStart->addHours(12);

// $sheduleFormat = 
// '[
//     {"day":"1",
//     "date_start":'. $day1DateStart->toString() .',
//     "date_end":'. $day1DateEnd->toString() .'
//     },
    
//     {"day":"2",
//     "date_start":'. $day2DateStart->toString() .',
//     "date_end":'. $day2DateEnd->toString() .'
//     }
// ]';



        Event::factory()->create([
            'title' => 'Adi poker event',
        ]);

        Event::factory()->create([
            'title' => 'Life of poker event',
        ]);
    }
}
