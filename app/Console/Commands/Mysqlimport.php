<?php

namespace App\Console\Commands;

use App\Models\Event;
use App\Models\EventReport;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
// use Thamaraiselvam\MysqlImport\Import;
// use Thamaraiselvam\MysqlImport\Import;

class Mysqlimport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mysql:import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $eventReports = new EventReport;



        $eventReports->setConnection('mysql2');

        foreach ($eventReports->get() as $event) {

            $isMatch = false;
            foreach (EventReport::all() as $repo) {

                if ($event->id == $repo->id)
                    $isMatch = true;

            }

            if ($isMatch == false)
                dump($event);
                // dump('no one here huh');

        }

        $other = new EventReport;

        // $other->setConnection('mysql');

        // dd($other->getConnectionName());

        // foreach ($eventReports->all() as $report) {

        //     if (EventReport::find($report->id)->title == '' || EventReport::find($report->id)->title == null)
        //         dump('asdasd');
        //     // dump(EventReport::find($report->id)->title);

        //     if (EventReport::find($report->id) == null)
        //         dump('this is not existing');

        // }

        // dd($eventReports->find(9)->title, EventReport::find(9)->title);

        // dd($eventReports->all()->count(), EventReport::all()->count());

    // $users = DB::connection('mysql2')->select(...);

    // $filename = 'database.sql';
    // $username = 'root';
    // $password = '';
    // $database = 'sampleproject';
    // $host = 'localhost';
    // $adi = new Import($filename, $username, $password, $database, $host);

    // dd($adi);

    return Command::SUCCESS;
    }
}
