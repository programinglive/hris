<?php

namespace Database\Seeders;

use App\Models\Branch;
use App\Models\Company;
use App\Models\Department;
use App\Models\Division;
use Illuminate\Database\Seeder;

class DivisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $company = Company::first();
        $branch = Branch::first();
        $department = Department::first();

        Division::create([
            'company_id' => $company->id,
            'branch_id' => $branch->id,
            'department_id' => $department->id,
            'company_code' => $company->code,
            'company_name' => $company->name,
            'branch_code' => $branch->code,
            'branch_name' => $branch->name,
            'department_code' => $department->code,
            'department_name' => $department->name,
            'code' => 'DIV001',
            'name' => 'Division A',
            'description' => fake()->text(100),
            'created_by' => 1,
        ]);
    }
}