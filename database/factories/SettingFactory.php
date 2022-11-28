<?php

namespace Database\Factories;

use App\Models\Article;
use App\Models\Author;
use Backpack\Settings\app\Models\Setting;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class SettingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Setting::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // $get = base64_encode(file_get_contents('https://www.fillmurray.com/640/360'));
        // dd(base64_encode($get));

        return [
            'key' => $this->faker->name,
            'name' => $this->faker->slug,
            'description' => $this->faker->paragraph(2),
            'field' => '{"name":"value","label":"Value","type":"text"}',
            'value' =>  $this->faker->paragraph(2),
        ];
    }
}
