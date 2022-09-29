<?php

namespace App\Presenters;

use JsonLd\Context;

class WebsitePresenter 
{
    /**
     * Create JSON-LD object.
     *
     * @return \JsonLd\Context
     */
    public function webpage()
    {
      return \JsonLd\Context::create('web_page', [
        'headline' => 'Home',
        'description' => 'Home page',
        'url' => 'https://lifeofpoker.com',
    ]);
    }

    public function website()
    {
      return \JsonLd\Context::create('web_site', [
        'headline' => 'Life of poker',
        'description' => 'Bringing actions to your doorstep',
        'url' => 'https://lifeofpoker.com',
    ]);
    }

    public function organization()
    {
      return \JsonLd\Context::create('organization', [
        'headline' => 'Life of poker',
        'description' => 'Poker',
        'mainEntityOfPage' => [
            'url' => 'https://lifeofpoker.com',
        ]
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