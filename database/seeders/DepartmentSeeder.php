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
        $companies = Company::all();

        foreach ($companies as $company) {

            $branch = Branch::first();

            Department::factory()->create([
                'company_id' => $company->id,
                'company_code' => $company->code,
                'company_name' => $company->name,
                'branch_id' => $branch->id,
                'branch_code' => $branch->code,
                'branch_name' => $branch->name,
                'code' => 'DEP'.str_pad((Department::count() + 1), 3, '0', STR_PAD_LEFT),
            ]);
        }

        foreach ($companies as $company) {

            $branch = Branch::orderBy('id', 'desc')->first();

            Department::factory()->create([
                'company_id' => $company->id,
                'company_code' => $company->code,
                'company_name' => $company->name,
                'branch_id' => $branch->id,
                'branch_code' => $branch->code,
                'branch_name' => $branch->name,
                'code' => 'DEP'.str_pad((Department::count() + 1), 3, '0', STR_PAD_LEFT),
            ]);
        }
    }
}