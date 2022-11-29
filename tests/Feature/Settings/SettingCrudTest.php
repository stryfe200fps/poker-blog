
<?php

use Backpack\Settings\app\Models\Setting;
use Backpack\Settings\database\seeds\SettingsTableSeeder;



$route = 'setting';

beforeEach(function () {
  $this->artisan('db:seed --class=SettingDefaultSeeder');
});

it('Setting is inside the database', function () {
  test()->assertDatabaseHas('settings', [
    'key' => 'youtube_1',
    'key' => 'youtube_2',
    'key' => 'youtube_3',
    'key' => 'admin_email',
    'key' => 'website_description',
    'key' => 'sm_image_width'
  ]);
});
