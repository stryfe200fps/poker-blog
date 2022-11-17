<?php

namespace App\Console\Commands;

use Dymantic\InstagramFeed\Profile;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class FetchInstagram extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:instagram ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update instagram';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {
            $profile = Profile::where('username', env('INSTAGRAM_USERNAME'))->firstOrFail()->refreshFeed(10);
        } catch (Exception $e) {
            Log::error('error in instagram in command');
        }

    return Command::SUCCESS;
    }
}
