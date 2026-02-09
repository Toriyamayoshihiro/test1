<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word(),
            'brand_name' => $this->faker->company(),
            'description' => $this->faker->sentence(),
            'image' => 'dummy.jpg',
            'price' => 1000,
            'condition_id' => \App\Models\Condition::factory(), 
            'user_id' => \App\Models\User::factory(),
        ];
    }
}
