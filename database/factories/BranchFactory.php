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
        $company = Company::factory()->create();

        return [
            'company_id' => $company->id,
            'code' => BranchController::generateCode(),
            'name' => $this->faker->company(),
            'type' => 'branch',
            'company_code' => $company->code,
            'company_name' => $company->name,
        ];
    }
}
