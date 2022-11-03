<?php

namespace Database\Factories;

use App\Models\Glossary;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class GlossaryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     * 
     */

    protected $model = Glossary::class;

    public function definition()
    {
        return [
            'word' => $this->faker->word()
        ];
    }
}
