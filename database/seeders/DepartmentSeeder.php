<?php

namespace Database\Seeders;

use App\Models\Branch;
use App\Models\Company;
use App\Models\Department;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $company = Company::first();
        $branch = Branch::first();

        Department::create([
            'company_id' => $company->id,
            'branch_id' => $branch->id,
            'company_code' => $company->code,
            'company_name' => $company->name,
            'branch_code' => $branch->code,
            'branch_name' => $branch->name,
            'code' => 'D001',
            'name' => 'Department A',
            'description' => fake()->text(100),
            'created_by' => 1,
        ]);
    }
}