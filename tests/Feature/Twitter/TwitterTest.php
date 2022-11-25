<?php

test('twitter has local endpoints', function () {
    $this->artisan('update:tweets');

    $twitterApi = $this->get('api/twitter');

    expect(count($twitterApi['data']))->toBe(2);
    $twitterApi->assertStatus(200);
});
