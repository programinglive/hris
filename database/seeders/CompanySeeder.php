<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Company::create([
            'code' => 'C001',
            'name' => fake()->company(),
            'npwp' => fake()->regexify('[0-9]{15}'),
            'email' => fake()->unique()->safeEmail(),
            'address' => fake()->streetAddress(),
            'phone' => fake()->phoneNumber(),
            'created_by' => 1,
            'updated_by' => 1,
        ]);
    }
}