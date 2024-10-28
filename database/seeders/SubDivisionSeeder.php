<?php

namespace Database\Seeders;

use App\Models\Branch;
use App\Models\Company;
use App\Models\Department;
use App\Models\Division;
use App\Models\SubDivision;
use Illuminate\Database\Seeder;

class SubDivisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companies = Company::all();

        foreach ($companies as $company) {

            $branch = Branch::first();
            $department = Department::first();
            $division = Division::first();

            SubDivision::factory()->create([
                'company_id' => $company->id,
                'company_code' => $company->code,
                'company_name' => $company->name,
                'branch_id' => $branch->id,
                'branch_code' => $branch->code,
                'branch_name' => $branch->name,
                'department_id' => $department->id,
                'department_code' => $department->code,
                'department_name' => $department->name,
                'division_id' => $division->id,
                'division_code' => $division->code,
                'division_name' => $division->name,
                'code' => 'SDIV'.str_pad((SubDivision::count() + 1), 3, '0', STR_PAD_LEFT),
            ]);
        }

        foreach ($companies as $company) {

            $branch = Branch::orderBy('id', 'desc')->first();
            $department = Department::orderBy('id', 'desc')->first();
            $division = Division::orderBy('id', 'desc')->first();

            SubDivision::factory()->create([
                'company_id' => $company->id,
                'company_code' => $company->code,
                'company_name' => $company->name,
                'branch_id' => $branch->id,
                'branch_code' => $branch->code,
                'branch_name' => $branch->name,
                'department_id' => $department->id,
                'department_code' => $department->code,
                'department_name' => $department->name,
                'division_id' => $division->id,
                'division_code' => $division->code,
                'division_name' => $division->name,
                'code' => 'SDIV'.str_pad((SubDivision::count() + 1), 3, '0', STR_PAD_LEFT),
            ]);
        }
    }
}
