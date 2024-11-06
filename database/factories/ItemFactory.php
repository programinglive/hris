<?php

namespace Database\Factories;

use App\Models\Item;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Item>
 */
class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'code' => $this->faker->ean8,
            'name' => $this->faker->sentence(3),
            'description' => $this->faker->sentence(10),
            'price' => $this->faker->randomFloat(2, 0, 1000),
            'date_request' => $this->faker->dateTimeBetween('-1 year'),
            'date_receive' => $this->faker->dateTimeBetween('-1 year'),
            'date_approve' => $this->faker->dateTimeBetween('-1 year'),
            'module' => 'inventory',
            'module_code' => $this->faker->ean8,
            'module_name' => $this->faker->sentence(3),
            'status' => 'active',
        ];
    }
}
