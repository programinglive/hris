<?php

namespace Database\Factories;

use App\Http\Controllers\BranchController;
use App\Models\Branch;
use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Branch>
 */
class BranchFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'company_id' => Company::factory()->create()->id,
            'code' => BranchController::generateCode(),
            'name' => $this->faker->company(),
            'type' => 'branch',
        ];
    }
}