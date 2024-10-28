<?php

namespace Database\Seeders;

use App\Models\Branch;
use App\Models\Brand;
use App\Models\Company;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $company = Company::first();
        $branch = Branch::first();

        Brand::create([
            'company_id' => $company->id,
            'branch_id' => $branch->id,
            'company_code' => $company->code,
            'company_name' => $company->name,
            'branch_code' => $branch->code,
            'branch_name' => $branch->name,
            'code' => 'B001',
            'name' => fake()->name,
            'created_by' => 1,
            'updated_by' => 1,
        ]);
    }
}