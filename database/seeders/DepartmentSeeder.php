<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing departments to avoid duplicates
        DB::statement('PRAGMA foreign_keys = OFF');
        Department::truncate();
        DB::statement('PRAGMA foreign_keys = ON');
        
        // Get all companies
        $companies = Company::all();
        
        // Sample departments for each company
        $departmentTemplates = [
            [
                'name' => 'Human Resources',
                'description' => 'Responsible for recruiting, onboarding, training, and employee relations',
                'code' => 'HUM-001'
            ],
            [
                'name' => 'Finance',
                'description' => 'Responsible for financial planning, management, and reporting',
                'code' => 'FIN-001'
            ],
            [
                'name' => 'Information Technology',
                'description' => 'Responsible for technology infrastructure and software development',
                'code' => 'IT-001'
            ],
        ];
        
        foreach ($companies as $company) {
            // Limit to first 3 companies to reduce total number of departments
            if ($company->id > 3) {
                continue;
            }
            
            foreach ($departmentTemplates as $template) {
                // Create unique code by combining company ID with department code
                $uniqueCode = $company->id . '-' . $template['code'];
                
                $department = Department::create([
                    'name' => $template['name'],
                    'description' => $template['description'],
                    'company_id' => $company->id,
                    'status' => 'active',
                    'code' => $uniqueCode
                ]);
                
                $this->command->info("Created department {$department->name} for company {$company->name}");
            }
        }
    }
}
