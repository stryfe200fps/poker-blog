<?php

namespace App\Console\Commands;

use App\Models\Player;
use App\Models\Tag;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class GenerateTags extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:tag';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This will make a tags for users';

    public function handle()
    {
        $users = Player::all();

        foreach ($users as $user) {
            $slugifiedName = Str::slug($user->name);

            if (Tag::where('slug', $slugifiedName)->count()) {
                continue;
            }

            Tag::create([
                'title' => $user->name,
                'slug' => $slugifiedName,
            ]);
        }

        return Command::SUCCESS;
    }
}
