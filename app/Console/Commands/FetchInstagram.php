<?php

namespace App\Console\Commands;

use Exception;
use App\Models\SocialMedia;
use Illuminate\Console\Command;
use Dymantic\InstagramFeed\Profile;
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
            $profile = Profile::where('username', env('INSTAGRAM_USERNAME'))->firstOrFail()->refreshFeed(5);
            SocialMedia::where('type', 'instagram')->delete();
            foreach ($profile as $image) { 

                if ($image->type === 'video')
                    continue;

                $social = SocialMedia::create([
                    'content' => $image->caption,
                    'type' => 'instagram',
                    'image' => $image->url,
                ]);
            }

        } catch (Exception $e) {
            Log::error('error in instagram in command');
        }

    return Command::SUCCESS;
    }
}
