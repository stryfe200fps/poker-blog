<?php

namespace App\Presenters;

class WebsitePresenter
{
    /**
     * Create JSON-LD object.
     *
     * @return \JsonLd\Context
     */
    public function webpage($page = 'Home', $url = '/')
    {
        return \JsonLd\Context::create('web_page', [
            'url' => request()->url(),
        ]);
    }

    public function website()
    {
        return \JsonLd\Context::create('web_site', [
            'headline' => 'Life of poker',
            'description' => 'Bringing actions to your doorstep',
            'url' => config('app.url'),
        ]);
    }

    public function organization()
    {
        return \JsonLd\Context::create('organization', [
            'headline' => 'Life of poker',
            'description' => 'Poker',
            'mainEntityOfPage' => [
                'url' => config('app.url'),
            ],
        ]);
    }

    // public function brand()
    // {
    //   return \JsonLd\Context::create('brand', [
    //     'name' => 'Life of poker brand',
    //     'description' => 'Poker',
    //     'mainEntityOfPage' => [
    //         'url' => 'https://google.com/article',
    //     ]
    // ]);
    // }
}
