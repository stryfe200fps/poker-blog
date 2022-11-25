<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Log\Logger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use League\Glide\ServerFactory;
use Illuminate\Contracts\Filesystem\Filesystem;
use League\Glide\Responses\LaravelResponseFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ImageController extends Controller
{
    //
    // public function __invoke(Request $request, Filesystem $fileSystem, Media $media)
    // {
    //     $server = ServerFactory::create([
    // 'response' => new LaravelResponseFactory(app('request'))
    // ]);
    //     }

    public function regenerate()
    {
        \Artisan::call("media-library:regenerate --force ");
        Logger('Regenerated Sucessfully');
        return redirect()->back();
    }

    public function show(Filesystem $filesystem, Media $media)
    {
        $server = ServerFactory::create([
            'response' => new LaravelResponseFactory(app('request')),
            'source' => $filesystem->getDriver(),
            'cache' => $filesystem->getDriver(),
            'cache_path_prefix' => '.cache',
            'base_url' => 'img',
        ]);
   
        
        try {
           return $server->getImageResponse("/public/$media->id/$media->file_name", request()->all());
         } catch (Exception $e) { Logger('Image was not found'); }

        $path = public_path().'/default-img.png';
        return response()->file($path);
    }
    
}
