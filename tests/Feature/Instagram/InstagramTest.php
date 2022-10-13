<?php

use Atymic\Twitter\Facade\Twitter;

test('twitter has local endpoints', function () {
    // $feed = \Dymantic\InstagramFeed\InstagramFeed::for('adrianradores_')->refresh();

    $profile = \Dymantic\InstagramFeed\Profile::new('lifeofpoker_com');

    // dd($profile->feed());

    // dd($profile->getInstagramAuthUrl());
    $this->get($profile->getInstagramAuthUrl());
    $feed = \Dymantic\InstagramFeed\InstagramFeed::for('lifeofpoker_com');


    // $this->artisan('update:tweets');

    // $twitterApi = $this->get('api/twitter');

    // expect(count($twitterApi['data']))->toBe(2);
    // $twitterApi->assertStatus(200);
});
