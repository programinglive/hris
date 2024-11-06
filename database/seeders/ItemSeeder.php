<?php

namespace Database\Seeders;

use App\Models\Branch;
use App\Models\Company;
use App\Models\Department;
use App\Models\Division;
use App\Models\Item;
use App\Models\Level;
use App\Models\Position;
use App\Models\SubDivision;
use App\Models\User;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companies = Company::all();

        foreach ($companies as $key => $company) {
            $branch = Branch::find($key + 1);
            $department = Department::find($key + 1);
            $division = Division::find($key + 1);
            $subDivision = SubDivision::find($key + 1);
            $position = Position::find($key + 1);
            $level = Level::find($key + 1);

            $employee = User::find($key + 1);
            $approver = User::find($key + 2);
            $receiver = User::find($key + 2);

            Item::factory([
                'company_id' => $company->id,
                'branch_id' => $branch->id,
                'department_id' => $department->id,
                'division_id' => $division->id,
                'sub_division_id' => $subDivision->id,
                'position_id' => $position->id,
                'level_id' => $level->id,
                'company_code' => $company->code,
                'company_name' => $company->name,
                'branch_code' => $branch->code,
                'branch_name' => $branch->name,
                'department_code' => $department->code,
                'department_name' => $department->name,
                'division_code' => $division->code,
                'division_name' => $division->name,
                'sub_division_code' => $subDivision->code,
                'sub_division_name' => $subDivision->name,
                'position_code' => $position->code,
                'position_name' => $position->name,
                'level_code' => $level->code,
                'level_name' => $level->name,
                'module' => 'inventory',
                'status' => 'active',
                'user_id' => $employee->id,
                'employee_nik' => $employee->details->nik,
                'employee_name' => $employee->name,
                'approver_id' => $approver->id,
                'approver_nik' => $approver->details->nik,
                'approver_name' => $approver->name,
                'receiver_id' => $receiver->id,
                'receiver_nik' => $receiver->details->nik,
                'receiver_name' => $receiver->name,
                'code' => 'ITM'.str_pad((Item::count() + 1), 3, '0', STR_PAD_LEFT),
            ])->create();
        }
    }
}