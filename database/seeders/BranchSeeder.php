<?php

namespace Database\Seeders;

use App\Models\Branch;
use App\Models\Company;
use Illuminate\Database\Seeder;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $company = Company::first();

        Branch::create([
            'company_id' => $company->id,
            'code' => 'B001',
            'name' => fake()->name,
            'type' => fake()->randomElement(['branch', 'partner']),
            'company_code' => $company->code,
            'company_name' => $company->name,
            'created_by' => 1,
            'updated_by' => 1,
        ]);
    }
}