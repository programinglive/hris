<?php

namespace Database\Seeders;

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
        $companies = Company::all();

        foreach ($companies as $key => $company) {

            $branch = $company->branches()->first();
            $department = Department::find($key + 1);

            Division::factory()->create([
                'company_id' => $company->id,
                'company_code' => $company->code,
                'company_name' => $company->name,
                'branch_id' => $branch->id,
                'branch_code' => $branch->code,
                'branch_name' => $branch->name,
                'department_id' => $department->id,
                'department_code' => $department->code,
                'department_name' => $department->name,
                'code' => 'DIV'.str_pad((Division::count() + 1), 3, '0', STR_PAD_LEFT),
            ]);
        }
    }
}