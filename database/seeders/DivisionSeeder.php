<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Division;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DivisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing divisions to avoid duplicates
        DB::statement('PRAGMA foreign_keys = OFF');
        Division::truncate();
        DB::statement('PRAGMA foreign_keys = ON');
        
        // Get all departments
        $departments = Department::all();
        
        if ($departments->isEmpty()) {
            $this->command->info("No departments found. Skipping division creation.");
            return;
        }
        
        // Division templates by department name
        $divisionTemplates = [
            'Human Resources' => [
                [
                    'name' => 'Recruitment', 
                    'description' => 'Responsible for attracting and hiring new talent',
                    'code' => 'REC-001'
                ],
                [
                    'name' => 'Training & Development', 
                    'description' => 'Responsible for employee training and career development',
                    'code' => 'TRD-001'
                ],
                [
                    'name' => 'Employee Relations', 
                    'description' => 'Responsible for maintaining positive employee relations',
                    'code' => 'ERP-001'
                ],
            ],
            'Finance' => [
                [
                    'name' => 'Accounting', 
                    'description' => 'Responsible for financial record keeping and reporting',
                    'code' => 'ACC-001'
                ],
                [
                    'name' => 'Payroll', 
                    'description' => 'Responsible for employee compensation and benefits',
                    'code' => 'PAY-001'
                ],
                [
                    'name' => 'Financial Planning', 
                    'description' => 'Responsible for budgeting and financial forecasting',
                    'code' => 'FP-001'
                ],
            ],
            'Information Technology' => [
                [
                    'name' => 'Software Development', 
                    'description' => 'Responsible for application development and maintenance',
                    'code' => 'SD-001'
                ],
                [
                    'name' => 'Infrastructure', 
                    'description' => 'Responsible for IT infrastructure and networks',
                    'code' => 'INF-001'
                ],
                [
                    'name' => 'IT Support', 
                    'description' => 'Responsible for technical support and troubleshooting',
                    'code' => 'ITS-001'
                ],
            ],
            // Default divisions for any department type
            'default' => [
                [
                    'name' => 'Administration', 
                    'description' => 'Responsible for administrative tasks',
                    'code' => 'ADM-001'
                ],
                [
                    'name' => 'Operations', 
                    'description' => 'Responsible for operational activities',
                    'code' => 'OPS-001'
                ],
                [
                    'name' => 'Development', 
                    'description' => 'Responsible for development and growth',
                    'code' => 'DEV-001'
                ],
            ],
        ];
        
        foreach ($departments as $department) {
            // Get division templates for this department or use default
            $templates = $divisionTemplates[$department->name] ?? $divisionTemplates['default'];
            
            // Create divisions for this department
            foreach ($templates as $template) {
                // Create unique code by combining department ID with division code
                $uniqueCode = $department->id . '-' . $template['code'];
                
                $division = Division::create([
                    'name' => $template['name'],
                    'description' => $template['description'],
                    'department_id' => $department->id,
                    'is_active' => true,
                    'code' => $uniqueCode
                ]);
                
                $this->command->info("Created division {$division->name} for department {$department->name}");
            }
        }
    }
}
