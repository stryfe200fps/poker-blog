<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class LiveReportEventChipTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::table('event_chip_event_report')->delete();

        \DB::table('event_chip_event_report')->insert([
            0 => [
                'id' => 14,
                'live_report_id' => 5,
                'live_report_player_id' => 14,
            ],
            1 => [
                'id' => 15,
                'live_report_id' => 5,
                'live_report_player_id' => 15,
            ],
            2 => [
                'id' => 16,
                'live_report_id' => 5,
                'live_report_player_id' => 16,
            ],
            3 => [
                'id' => 17,
                'live_report_id' => 5,
                'live_report_player_id' => 17,
            ],
            4 => [
                'id' => 18,
                'live_report_id' => 5,
                'live_report_player_id' => 18,
            ],
            5 => [
                'id' => 19,
                'live_report_id' => 5,
                'live_report_player_id' => 19,
            ],
            6 => [
                'id' => 20,
                'live_report_id' => 5,
                'live_report_player_id' => 20,
            ],
            7 => [
                'id' => 21,
                'live_report_id' => 5,
                'live_report_player_id' => 21,
            ],
            8 => [
                'id' => 24,
                'live_report_id' => 8,
                'live_report_player_id' => 24,
            ],
            9 => [
                'id' => 25,
                'live_report_id' => 7,
                'live_report_player_id' => 25,
            ],
            10 => [
                'id' => 47,
                'live_report_id' => 12,
                'live_report_player_id' => 47,
            ],
            11 => [
                'id' => 48,
                'live_report_id' => 12,
                'live_report_player_id' => 48,
            ],
            12 => [
                'id' => 49,
                'live_report_id' => 12,
                'live_report_player_id' => 49,
            ],
            13 => [
                'id' => 50,
                'live_report_id' => 12,
                'live_report_player_id' => 50,
            ],
            14 => [
                'id' => 51,
                'live_report_id' => 12,
                'live_report_player_id' => 51,
            ],
        ]);
    }
}
