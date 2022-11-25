<?php

namespace App\Console\Commands;

use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
// use Stichoza\GoogleTranslate\GoogleTranslate;


class CreateJsonTranslationFileCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'translation:generate-json';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This commands go through en lang files and creates en.json file';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $storage = Storage::disk('languages');
        $directories = $storage->directories();

        $supportedLocales = config('app.supported_locales');
            // $tr = new GoogleTranslate(); // Translates to 'en' from auto-detected language by default
           foreach ($directories as $directory) {
            $files = $storage->allFiles($directory);

            foreach ($files as $file) {
                $contents = require $storage->path($file);

                if ($file == 'en/core.php') {

                    foreach ($supportedLocales as $locale) {
                    $path = resource_path("lang/$locale");

                    $tr->setSource(); 
                    $tr->setTarget($locale);

                    if (! File::isDirectory($path)) {
                        File::makeDirectory($path, 0775, true, true);
                    }
                    $file = resource_path("lang/$locale/core.php");
                    $str = '';
                    foreach ($contents as $key => $content) {
                        try { 
                        $translatedContent = htmlspecialchars($tr->translate($content)) ?? '';
                        $str .= "'$key'  => '$translatedContent',";
                        } catch (Exception $e) {

                        }
                    }
                    File::put($file, '<?php return [ '.$str.' ]; ');

                    sleep(1);
                    }
                }
            }
            }

            sleep(3);

            foreach ($directories as $directory) {
            $files = $storage->allFiles($directory);
            $array = [];
            foreach ($files as $file) {
                //do not include "api" directory, because api is only for API calls
                if (str_starts_with($file, $directory.'/api')) {
                    continue;
                }
                $baseName = str_replace('.php', '', basename($file));
                $contents = require $storage->path($file);
                $array[$baseName] = $contents;
            }

            $filePath = sprintf('%s.json', $directory);
            $storage->put($filePath, json_encode($array, JSON_PRETTY_PRINT));
        }

        $this->info('Files generated');

        return 0;
    }
}
