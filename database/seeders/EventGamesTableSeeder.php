<?php

namespace Database\Seeders;

use App\Models\EventGameTable;
use Exception;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventGamesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $path = storage_path('adi.csv');
        $csv = file_get_contents($path);
        $lines = explode(PHP_EOL, $csv);

        $array = array();
        foreach ($lines as $line) {
            $array[] = str_getcsv($line);
        }

        foreach ($array as $table) { 
            try { 
            EventGameTable::factory()->create([
                'code' => trim($table[0]),
                'title' => trim($table[1])
            ]);
            } catch (Exception $e) { }
        }
    }
}
