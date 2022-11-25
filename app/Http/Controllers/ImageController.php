<?php

namespace App\Http\Controllers;

<<<<<<< HEAD
use Exception;
use Illuminate\Log\Logger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
=======
use Illuminate\Http\Request;
>>>>>>> add1d79f3c28592566e8c668557fa86d9e383b32
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

<<<<<<< HEAD
    public function regenerate()
    {
        \Artisan::call("media-library:regenerate --force ");
        Logger('Regenerated Sucessfully');
        return redirect()->back();
    }

=======
>>>>>>> add1d79f3c28592566e8c668557fa86d9e383b32
    public function show(Filesystem $filesystem, Media $media)
    {
        $server = ServerFactory::create([
            'response' => new LaravelResponseFactory(app('request')),
            'source' => $filesystem->getDriver(),
            'cache' => $filesystem->getDriver(),
            'cache_path_prefix' => '.cache',
            'base_url' => 'img',
        ]);
   
<<<<<<< HEAD
        
        try {
           return $server->getImageResponse("/public/$media->id/$media->file_name", request()->all());
         } catch (Exception $e) { Logger('Image was not found'); }

        $path = public_path().'/default-img.png';
        return response()->file($path);
=======
        return $server->getImageResponse("/public/$media->id/$media->file_name", request()->all());
>>>>>>> add1d79f3c28592566e8c668557fa86d9e383b32
    }
    
}
