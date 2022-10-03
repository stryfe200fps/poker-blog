<?php

namespace Database\Seeders;

use App\Models\LiveReport;
use Illuminate\Database\Seeder;

class LiveReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $reportsTitle = [
            'Dhanesh Chainani triples up last hand before the break',
            'Short stacked Thijs Hilberts doubles up',
            'After lots of movements in stacks a 3 way deal has been made',
            'Two 3-way all-ins ended the APPT Main Event, Xin Hua Lai wins the APPT Main Event (₱5,950,635)',
        ];
        foreach ($reportsTitle as $report) {
            EventReport::factory()->create([
                'title' => $report,
            ]);
        }
    }
}
