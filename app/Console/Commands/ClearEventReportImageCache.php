<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Cache;

use Illuminate\Support\Facades\File;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

use function Pest\Laravel\delete;

class ClearEventReportImageCache extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'report-image:cache';

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
        $caches = Cache::all();

        foreach ($caches as $cache) {

            if ((int)$cache->expiration <= strtotime(Carbon::now())) {

                $uuid = unserialize($cache->value);

                if (!is_string($uuid) || (preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/', $uuid) !== 1)) {
                    continue;
}
               $media = Media::findByUuid(unserialize($cache->value));
               
               if ($media === null)
                continue;
            //    if (File::exists($media->getPath())) { 

                    $name = str_replace('lifeofpoker_cache_', '',  $cache->key);
                    $replace = str_replace('/'. $name.'.jpg', '' , $media->getPath() );
                    File::deleteDirectory($replace. '/conversions');


                $cache->where('key', $cache->key)->delete();

            }
        }
        return Command::SUCCESS;
    }
}
