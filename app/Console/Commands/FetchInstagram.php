<?php

namespace App\Console\Commands;

<<<<<<< HEAD
use Exception;
use App\Models\SocialMedia;
use Illuminate\Console\Command;
use Dymantic\InstagramFeed\Profile;
=======
use Dymantic\InstagramFeed\Profile;
use Exception;
use Illuminate\Console\Command;
>>>>>>> add1d79f3c28592566e8c668557fa86d9e383b32
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
<<<<<<< HEAD
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

=======
            $profile = Profile::where('username', env('INSTAGRAM_USERNAME'))->firstOrFail()->refreshFeed(10);
>>>>>>> add1d79f3c28592566e8c668557fa86d9e383b32
        } catch (Exception $e) {
            Log::error('error in instagram in command');
        }

    return Command::SUCCESS;
    }
}
