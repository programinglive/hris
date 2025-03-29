<?php

namespace Database\Factories;

use App\Models\Branch;
use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

class BranchFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Branch::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $cities = ['Jakarta', 'Bandung', 'Surabaya', 'Medan', 'Makassar', 'Bali', 'Yogyakarta', 'Semarang', 'Palembang', 'Balikpapan'];
        $city = $this->faker->randomElement($cities);
        
        $branchTypes = ['Main Office', 'Regional Office', 'Sales Office', 'Service Center', 'Warehouse', 'Retail Store'];
        $branchType = $this->faker->randomElement($branchTypes);
        
        return [
            'name' => $city . ' ' . $branchType,
            'code' => strtoupper(substr($city, 0, 3)) . '-' . $this->faker->numerify('###'),
            'address' => $this->faker->streetAddress(),
            'city' => $city,
            'state' => $this->faker->state(),
            'postal_code' => $this->faker->postcode(),
            'country' => 'Indonesia',
            'phone' => '+62' . $this->faker->numerify('##########'),
            'email' => strtolower(substr($city, 0, 3)) . '.' . $this->faker->word() . '@beautyhris.com',
            'company_id' => Company::factory(),
            'is_main_branch' => false,
            'is_active' => $this->faker->boolean(90), // 90% chance of being active
            'description' => $this->faker->paragraph(),
        ];
    }

    /**
     * Indicate that the branch is a main branch.
     *
     * @return static
     */
    public function mainBranch()
    {
        return $this->state(function (array $attributes) {
            return [
                'is_main_branch' => true,
                'is_active' => true, // Main branches are always active
            ];
        });
    }

    /**
     * Indicate that the branch is active.
     *
     * @return static
     */
    public function active()
    {
        return $this->state(function (array $attributes) {
            return [
                'is_active' => true,
            ];
        });
    }

    /**
     * Indicate that the branch is inactive.
     *
     * @return static
     */
    public function inactive()
    {
        return $this->state(function (array $attributes) {
            return [
                'is_active' => false,
                'is_main_branch' => false, // Inactive branches can't be main branches
            ];
        });
    }
}
