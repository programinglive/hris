<?php

namespace Database\Seeders;

use App\Models\Branch;
use App\Models\Company;
use App\Models\Department;
use App\Models\Division;
use App\Models\Level;
use App\Models\Position;
use App\Models\SubDivision;
use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companies = Company::all();

        foreach ($companies as $key => $company) {
            $user = User::factory()->create();

            $branch = Branch::find($key + 1);
            $department = Department::find($key + 1);
            $division = Division::find($key + 1);
            $subDivision = SubDivision::find($key + 1);
            $level = Level::find($key + 1);
            $position = Position::find($key + 1);

            UserDetail::factory()->create([
                'user_id' => $user->id,
                'nik' => 'EMP'.str_pad((UserDetail::count() + 1), 5, '0', STR_PAD_LEFT),
                'date_of_birth' => now()->subMonths(rand(1, 12))->format('Y-m-d'),
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
                'position_id' => $position->id,
                'position_code' => $position->code,
                'position_name' => $position->name,
            ]);
        }
    }
}