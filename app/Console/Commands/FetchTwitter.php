<?php

namespace App\Console\Commands;

use App\Models\SocialMedia;
use Illuminate\Console\Command;

class FetchTwitter extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:tweets ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update Tweets';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $querier = \Atymic\Twitter\Facade\Twitter::forApiV2()
         ->getQuerier();

        $result = $querier
        ->withOAuth2Client()
        ->get('users/by/username/Life_of_Poker');

        $query = $querier
        ->withOAuth2Client()
        ->get('users/'.$result->data->id.'/tweets');

        SocialMedia::where('type', 'twitter')->delete();
        foreach ($query->data as $tweet) {
            SocialMedia::create([
                'content' => $tweet->text,
                'type' => 'twitter',
                'image' => '',
                'social_media_id' => $tweet->id,
            ]);
        }
        return Command::SUCCESS;
    }
}
