<?php

namespace Database\Factories;

use App\Models\Page;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MenuItem>
 */
class MenuItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        return [
            'name' => 'Test',
            'type' => 'external_link',
            'link' => 'facebook.com',
            'parent_id' => 0,
            'page_id' => Page::factory()->create()->id 

        ];
    }
}
