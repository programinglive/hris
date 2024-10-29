<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Department;
use App\Models\Division;
use App\Models\SubDivision;
use App\Models\Level;
use Illuminate\Database\Seeder;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $companies = Company::all();

        foreach ($companies as $key => $company) {

            $branch = $company->branches()->first();
            $department = Department::find($key + 1);
            $division = Division::find($key + 1);
            $subDivision = SubDivision::find($key + 1);

            Level::factory()->create([
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
                'sub_division_id' => $subDivision->id,
                'sub_division_code' => $subDivision->code,
                'sub_division_name' => $subDivision->name,
                'code' => 'L'.str_pad((Level::count() + 1), 3, '0', STR_PAD_LEFT),
            ]);
        }
    }
}