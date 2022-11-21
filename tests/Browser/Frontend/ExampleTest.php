<?php

use Laravel\Dusk\Browser;
 
 
it('has homepage', function () {
    $this->browse(function (Browser $browser) {
    $visit = $browser->visit('/');
    $visit->assertSee('NEWS');
    });
});