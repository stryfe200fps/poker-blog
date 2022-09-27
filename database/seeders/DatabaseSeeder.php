<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Backpack\PermissionManager\app\Models\Role;
use Illuminate\Database\Seeder;

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
    }
}
