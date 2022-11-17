<?php

use Stichoza\GoogleTranslate\GoogleTranslate;

// use Stichoza\GoogleTranslate\GoogleTranslate;

test('test google translate', function () {
    $tr = new GoogleTranslate(); // Translates to 'en' from auto-detected language by default
    $tr->setSource(); // Detect language automatically

    $tr->setTarget('nl');
    // dd($tr->translate('city'));
});
