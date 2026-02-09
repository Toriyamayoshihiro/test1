<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Item;

class SoldItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'postal_code' => '123-1234',
            'address' => $this->faker->address(),
            'item_id' => Item::factory(),
            'user_id' => User::factory(),
        ];
    }
}
