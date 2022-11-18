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
            'value' => 'Life of poker description',
            'field' => $this->fieldType('textarea'),
            'active' => 1
        ]);

        // DEFAULT IMAGE SIZE
        Setting::create([
            'key' => 'default_image_width',
            'name' => 'Default Image Width',
            'description' => '',
            'value' => 200,
            'field' => $this->fieldType('number'),
            'active' => 1
        ]);
        Setting::create([
            'key' => 'default_image_height',
            'name' => 'Default Image Height',
            'description' => '',
            'value' => 200,
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
            'value' => 200,
            'field' => $this->fieldType('number'),
            'active' => 1
        ]);
        Setting::create([
            'key' => 'sm_image_height',
            'name' => 'Small Image Height',
            'description' => '',
            'value' => 200,
            'field' => $this->fieldType('number'),
            'active' => 1
        ]);
        //END SMALL IMAGE

        //MEDIUM IMAGE
        Setting::create([
            'key' => 'md_image_width',
            'name' => 'Medium Image Width',
            'description' => '',
            'value' => 200,
            'field' => $this->fieldType('number'),
            'active' => 1
        ]);
        Setting::create([
            'key' => 'md_image_height',
            'name' => 'Medium Image Height',
            'description' => '',
            'value' => 200,
            'field' => $this->fieldType('number'),
            'active' => 1
        ]);
        //END MEDIUM IMAGE

        //LARGE IMAGE
        Setting::create([
            'key' => 'lg_image_width',
            'name' => 'Large Image Width',
            'description' => '',
            'value' => 200,
            'field' => $this->fieldType('number'),
            'active' => 1
        ]);
        Setting::create([
            'key' => 'lg_image_height',
            'name' => 'Large Image Height',
            'description' => '',
            'value' => 200,
            'field' => $this->fieldType('number'),
            'active' => 1
        ]);
        //END LARGE IMAGE

        //EXTRA LARGE IMAGE
        Setting::create([
            'key' => 'xl_image_width',
            'name' => 'Extra Large Image',
            'description' => '',
            'value' => 200,
            'field' => $this->fieldType('number'),
            'active' => 1
        ]);
        Setting::create([
            'key' => 'xl_image_height',
            'name' => 'Extra Large Image Height',
            'description' => '',
            'value' => 200,
            'field' => $this->fieldType('number'),
            'active' => 1
        ]);
        //END EXTRA LARGE IMAGE



    }
}
