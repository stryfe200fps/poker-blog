<?php

use Illuminate\Foundation\Testing\DatabaseMigrations;

uses(DatabaseMigrations::class);

it('firstTest', function () {
  expect(0)->toBe(0);
});

it('second Test', function () {
  expect(0)->toBe(0);
});