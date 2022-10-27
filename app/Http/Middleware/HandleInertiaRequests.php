<?php

namespace App\Http\Middleware;

use App\Models\MenuItem;
use Butschster\Head\Contracts\MetaTags\MetaInterface;
use Illuminate\Http\Request;
use Inertia\Middleware;

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
            'supported_locales' => config('app.supported_locales'),
            // 'locale' => function () {
            //     return 'en';
            // },
            // 'language' => function () {

            //     $locale = session()->get('locale') != null ? session()->get('locale').'.json' : 'en.json';

            //     return translations(
            //         resource_path("lang/$locale")
            //     );
            // },
            'category' => MenuItem::getTree()->where('link', 'news')->first()->children ?? [],
        ]);
    }
}
