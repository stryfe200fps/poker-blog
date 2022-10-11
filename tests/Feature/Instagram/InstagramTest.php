<?php

use Atymic\Twitter\Facade\Twitter;

test('twitter has local endpoints', function () {
    // $feed = \Dymantic\InstagramFeed\InstagramFeed::for('adrianradores_')->refresh();

    $profile = \Dymantic\InstagramFeed\Profile::new('adrianradores_');

    // dd($profile->feed());

    // dd($profile->getInstagramAuthUrl());
    $this->get($profile->getInstagramAuthUrl());

    $feed = \Dymantic\InstagramFeed\InstagramFeed::for('adrianradores_');

    //  dd($feed);

    // $this->artisan('update:tweets');

    // $twitterApi = $this->get('api/twitter');

    // expect(count($twitterApi['data']))->toBe(2);
    // $twitterApi->assertStatus(200);
});
