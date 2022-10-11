<?php

namespace App\Http\Middleware;

use Inertia\Middleware;
use App\Models\MenuItem;
use App\Models\ArticleCategory;
use Illuminate\Http\Request;
use Butschster\Head\Contracts\MetaTags\MetaInterface;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Defines the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function share(Request $request): array
    {
        return array_merge(parent::share($request), [
            'title' => fn (MetaInterface $meta) => ($meta->toArray()['head'][0]['content']),
            'menu' => MenuItem::getTree(),
            'category' => MenuItem::getTree()->where('link', 'news')->first()->children ?? []
        ]);
    }
}
