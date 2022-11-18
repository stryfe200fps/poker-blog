<?php

namespace Database\Seeders;

use App\Models\Setting as ModelsSetting;
use Backpack\Settings\app\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingDefaultSeeder extends Seeder
{

    public function fieldType($type)
    {
        return '{"name":"value","label":"Value","type":"'.$type.'"}';
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::truncate();

        Setting::create([
            'key' => 'youtube_1',
            'name' => 'Youtube 1',
            'description' => 'Output youtube',
            'value' => 'youtube.com',
            'field' => $this->fieldType('text'),
            'active' => 1
        ]);

        Setting::create([
            'key' => 'youtube_2',
            'name' => 'Youtube 2',
            'description' => 'Output youtube',
            'value' => 'youtube.com',
            'field' => $this->fieldType('text'),
            'active' => 1
        ]);

        Setting::create([
            'key' => 'youtube_3',
            'name' => 'Youtube 3',
            'description' => 'Output youtube',
            'value' => 'youtube.com',
            'field' => $this->fieldType('text'),
            'active' => 1
        ]);

        Setting::create([
            'key' => 'website_description',
            'name' => 'Website Description',
            'description' => '',
            'value' => 'Life of poker is a one stop shop for all your poker needs. We are here to bring the action to your doorstep. Live event coverage, interviews, videos, podcasts and much more.',
            'field' => $this->fieldType('textarea'),
            'active' => 1
        ]);

        //images
        Setting::create([
            'key' => 'admin_email',
            'name' => 'Administrator email',
            'description' => '',
            'value' => 'info@lifeofpoker.com',
            'field' => $this->fieldType('text'),
            'active' => 1
        ]);

        Setting::create([
            'key' => 'website_description',
            'name' => 'Website Description',
            'description' => '',
            'value' => 'Life of poker is a one stop shop for all your poker needs. We are here to bring the action to your doorstep. Live event coverage, interviews, videos, podcasts and much more.',
            'field' => $this->fieldType('textarea'),
            'active' => 1
        ]);


        // DEFAULT IMAGE SIZE
        Setting::create([
            'key' => 'default_image_width',
            'name' => 'Default Image Width',
            'description' => '',
            'value' => 1600,
            'field' => $this->fieldType('number'),
            'active' => 1
        ]);
        Setting::create([
            'key' => 'default_image_height',
            'name' => 'Default Image Height',
            'description' => '',
            'value' => 900,
            'field' => $this->fieldType('number'),
            'active' => 1
        ]);
        //END DEFAULT IMAGE SIZE
        
        //EXTRA SMALL IMAGE
        Setting::create([
            'key' => 'xs_image_width',
            'name' => 'Extra Small Image Width',
            'description' => '',
            'value' => 200,
            'field' => $this->fieldType('number'),
            'active' => 1
        ]);
        Setting::create([
            'key' => 'xs_image_height',
            'name' => 'Extra Small Image Height',
            'description' => '',
            'value' => 200,
            'field' => $this->fieldType('number'),
            'active' => 1
        ]);
        //END EXTRA SMALL IMAGE




        //SMALL IMAGE
        Setting::create([
            'key' => 'sm_image_width',
            'name' => 'Small Image Width',
            'description' => '',
            'value' => 300,
            'field' => $this->fieldType('number'),
            'active' => 1
        ]);
        Setting::create([
            'key' => 'sm_image_height',
            'name' => 'Small Image Height',
            'description' => '',
            'value' => 250,
            'field' => $this->fieldType('number'),
            'active' => 1
        ]);
        //END SMALL IMAGE

        //MEDIUM IMAGE
        Setting::create([
            'key' => 'md_image_width',
            'name' => 'Medium Image Width',
            'description' => '',
            'value' => 640,
            'field' => $this->fieldType('number'),
            'active' => 1
        ]);
        Setting::create([
            'key' => 'md_image_height',
            'name' => 'Medium Image Height',
            'description' => '',
            'value' => 480,
            'field' => $this->fieldType('number'),
            'active' => 1
        ]);
        //END MEDIUM IMAGE



        //LARGE IMAGE
        Setting::create([
            'key' => 'lg_image_width',
            'name' => 'Large Image Width',
            'description' => '',
            'value' => 900,
            'field' => $this->fieldType('number'),
            'active' => 1
        ]);
        Setting::create([
            'key' => 'lg_image_height',
            'name' => 'Large Image Height',
            'description' => '',
            'value' => 600,
            'field' => $this->fieldType('number'),
            'active' => 1
        ]);
        //END LARGE IMAGE

        //EXTRA LARGE IMAGE
        Setting::create([
            'key' => 'xl_image_width',
            'name' => 'Extra Large Image',
            'description' => '',
            'value' => 1600,
            'field' => $this->fieldType('number'),
            'active' => 1
        ]);
        Setting::create([
            'key' => 'xl_image_height',
            'name' => 'Extra Large Image Height',
            'description' => '',
            'value' => 900,
            'field' => $this->fieldType('number'),
            'active' => 1
        ]);
        //END EXTRA LARGE IMAGE

    }
}
