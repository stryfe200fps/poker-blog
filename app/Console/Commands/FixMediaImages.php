<?php

namespace App\Console\Commands;

use Directory;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class FixMediaImages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'image:fix';

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

        $icons = storage_path('app/public');
        $allIconsInsideFolder =  File::directories($icons);
        foreach ($allIconsInsideFolder as $directory) { 
           $file = File::files($directory);
           rename( $file[0]->getLinkTarget(), $file[0]->getLinkTarget(). '.jpg');

        }

        return Command::SUCCESS;
    }
}
