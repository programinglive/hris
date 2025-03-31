<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Department;
use App\Models\Division;
use App\Models\Position;
use App\Models\SubDivision;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing positions to avoid duplicates
        DB::statement('PRAGMA foreign_keys = OFF');
        Position::truncate();
        DB::statement('PRAGMA foreign_keys = ON');

        // Get the first company
        $company = Company::with([
            'departments' => function ($query) {
                $query->with([
                    'divisions' => function ($query) {
                        $query->with(['subDivisions']);
                    },
                ]);
            },
            'levels',
        ])->first();

        if (! $company) {
            throw new \Exception('No company found');
        }

        // Get the departments for the first company
        $departments = $company->departments;

        if ($departments->isEmpty()) {
            // Create a default department structure
            $departmentWithDivisions = Department::create([
                'name' => 'Information Technology',
                'description' => 'Responsible for technology infrastructure and software development',
                'company_id' => $company->id,
                'is_active' => true,
                'code' => 'IT-'.$company->id.'-001',
            ]);

            // Create a division
            $division = Division::create([
                'name' => 'Development',
                'description' => 'Responsible for software development',
                'department_id' => $departmentWithDivisions->id,
                'is_active' => true,
                'code' => 'DEV-'.$departmentWithDivisions->id.'-001',
            ]);

            // Create a sub-division
            SubDivision::create([
                'name' => 'Backend',
                'description' => 'Responsible for backend development',
                'division_id' => $division->id,
                'is_active' => true,
                'code' => 'BCK-'.$division->id.'-001',
            ]);
        } else {
            // Find a department with at least one division and sub-division
            $departmentWithDivisions = $departments->first(function ($department) {
                if ($department->divisions->isEmpty()) {
                    return false;
                }

                $firstDivision = $department->divisions->first();
                if (! $firstDivision || $firstDivision->subDivisions->isEmpty()) {
                    return false;
                }

                return true;
            });

            if (! $departmentWithDivisions) {
                // Create a default department structure
                $departmentWithDivisions = Department::create([
                    'name' => 'Information Technology',
                    'description' => 'Responsible for technology infrastructure and software development',
                    'company_id' => $company->id,
                    'is_active' => true,
                    'code' => 'IT-'.$company->id.'-001',
                ]);

                // Create a division
                $division = Division::create([
                    'name' => 'Development',
                    'description' => 'Responsible for software development',
                    'department_id' => $departmentWithDivisions->id,
                    'is_active' => true,
                    'code' => 'DEV-'.$departmentWithDivisions->id.'-001',
                ]);

                // Create a sub-division
                SubDivision::create([
                    'name' => 'Backend',
                    'description' => 'Responsible for backend development',
                    'division_id' => $division->id,
                    'is_active' => true,
                    'code' => 'BCK-'.$division->id.'-001',
                ]);
            }
        }

        // Get the levels for the company
        $levels = $company->levels;

        // Create CEO position
        $ceoPosition = Position::create([
            'name' => 'CEO',
            'description' => 'Chief Executive Officer',
            'company_id' => $company->id,
            'department_id' => $departmentWithDivisions->id,
            'division_id' => $departmentWithDivisions->divisions->first()->id,
            'sub_division_id' => $departmentWithDivisions->divisions->first()->subDivisions->first()->id,
            'level_id' => $levels->where('level_order', 1)->first()->id,
            'is_active' => true,
            'code' => 'CEO-001',
        ]);

        // Create COO position
        $cooPosition = Position::create([
            'name' => 'COO',
            'description' => 'Chief Operating Officer',
            'company_id' => $company->id,
            'department_id' => $departmentWithDivisions->id,
            'division_id' => $departmentWithDivisions->divisions->first()->id,
            'sub_division_id' => $departmentWithDivisions->divisions->first()->subDivisions->first()->id,
            'level_id' => $levels->where('level_order', 2)->first()->id,
            'is_active' => true,
            'code' => 'COO-001',
        ]);

        // Create CFO position
        $cfoPosition = Position::create([
            'name' => 'CFO',
            'description' => 'Chief Financial Officer',
            'company_id' => $company->id,
            'department_id' => $departmentWithDivisions->id,
            'division_id' => $departmentWithDivisions->divisions->first()->id,
            'sub_division_id' => $departmentWithDivisions->divisions->first()->subDivisions->first()->id,
            'level_id' => $levels->where('level_order', 3)->first()->id,
            'is_active' => true,
            'code' => 'CFO-001',
        ]);

        // Create HR Manager position
        $hrManagerPosition = Position::create([
            'name' => 'HR Manager',
            'description' => 'Human Resources Manager',
            'company_id' => $company->id,
            'department_id' => $departmentWithDivisions->id,
            'division_id' => $departmentWithDivisions->divisions->first()->id,
            'sub_division_id' => $departmentWithDivisions->divisions->first()->subDivisions->first()->id,
            'level_id' => $levels->where('level_order', 4)->first()->id,
            'is_active' => true,
            'code' => 'HRM-001',
        ]);

        // Create HR Assistant position
        $hrAssistantPosition = Position::create([
            'name' => 'HR Assistant',
            'description' => 'Human Resources Assistant',
            'company_id' => $company->id,
            'department_id' => $departmentWithDivisions->id,
            'division_id' => $departmentWithDivisions->divisions->first()->id,
            'sub_division_id' => $departmentWithDivisions->divisions->first()->subDivisions->first()->id,
            'level_id' => $levels->where('level_order', 5)->first()->id,
            'is_active' => true,
            'code' => 'HRA-001',
        ]);

        $this->command->info('Created a total of 5 positions.');
    }
}
