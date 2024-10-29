<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Department;
use App\Models\Division;
use App\Models\Level;
use App\Models\Position;
use App\Models\SubDivision;
use Illuminate\Database\Seeder;

class PositionSeeder extends Seeder
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
            $level = Level::find($key + 1);

            Position::factory()->create([
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
                'level_id' => $level->id,
                'level_code' => $level->code,
                'level_name' => $level->name,
                'code' => 'P'.str_pad((Position::count() + 1), 3, '0', STR_PAD_LEFT),
            ]);
        }
    }
}
