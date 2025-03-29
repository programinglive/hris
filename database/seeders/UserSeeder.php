<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserDetail;
use App\Models\Company;
use App\Models\Branch;
use App\Models\Brand;
use App\Models\UserBrand;
use App\Models\Role;
use App\Models\Department;
use App\Models\Position;
use App\Models\Division;
use App\Models\SubDivision;
use App\Models\Level;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing user details to avoid duplicates
        DB::statement('PRAGMA foreign_keys = OFF');
        UserDetail::truncate();
        // Don't truncate users table as it may have admin user created in DatabaseSeeder
        DB::statement('PRAGMA foreign_keys = ON');
        
        // Make sure we have companies and branches
        $companies = Company::all();
        if ($companies->isEmpty()) {
            $this->command->info('No companies found. Please run CompanySeeder first.');
            return;
        }
        
        // Get roles for assignment
        $employeeRole = Role::where('name', 'employee')->first();
        $managerRole = Role::where('name', 'manager')->first();
        
        if (!$employeeRole || !$managerRole) {
            $this->command->info('Required roles not found. Please run RoleSeeder first.');
            return;
        }
        
        // Create users for each company with proper relationships
        $totalUsers = 0;
        foreach ($companies as $company) {
            // Get branches for this company
            $branches = $company->branches;
            if ($branches->isEmpty()) {
                $this->command->info("No branches found for company {$company->name}. Please run BranchSeeder first.");
                continue;
            }
            
            // Get brands for this company
            $brands = $company->brands;
            if ($brands->isEmpty()) {
                $this->command->info("No brands found for company {$company->name}. Please run BrandSeeder first.");
                continue;
            }
            
            // Find main branch for this company
            $mainBranch = $branches->firstWhere('is_main_branch', true) ?? $branches->first();
            
            // Create or find Management department
            $managementDept = Department::firstOrCreate(
                [
                    'company_id' => $company->id,
                    'name' => 'Management'
                ],
                [
                    'description' => 'Management Department',
                    'status' => 'active'
                ]
            );
            
            // Create a default division if it doesn't exist
            $managementDiv = Division::firstOrCreate(
                [
                    'department_id' => $managementDept->id,
                    'name' => 'Executive Management'
                ],
                [
                    'description' => 'Executive Management Division',
                    'status' => 'active'
                ]
            );
            
            // Create a default sub-division if it doesn't exist
            $managementSubDiv = SubDivision::firstOrCreate(
                [
                    'division_id' => $managementDiv->id,
                    'name' => 'Company Management'
                ],
                [
                    'description' => 'Company Management Sub-Division',
                    'status' => 'active'
                ]
            );
            
            // Create or find Executive level
            $executiveLevel = Level::firstOrCreate(
                [
                    'company_id' => $company->id,
                    'name' => 'Executive'
                ],
                [
                    'description' => 'Executive Level',
                    'level_order' => 1,
                    'status' => 'active'
                ]
            );
            
            // Create or find Manager position
            $managerPosition = Position::firstOrCreate(
                [
                    'company_id' => $company->id,
                    'name' => 'Company Manager'
                ],
                [
                    'description' => 'Company Manager Position',
                    'level_id' => $executiveLevel->id,
                    'sub_division_id' => $managementSubDiv->id,
                    'status' => 'active'
                ]
            );
            
            // Create company manager (1 per company)
            $companyManagerEmail = "manager." . strtolower(str_replace(' ', '', $company->name)) . "@beautyhris.com";
            $companyManager = User::firstOrCreate(
                ['email' => $companyManagerEmail],
                [
                    'name' => "Manager {$company->name}",
                    'password' => Hash::make('password'),
                ]
            );
            
            // Assign manager role to company manager
            if ($managerRole) {
                $companyManager->roles()->syncWithoutDetaching([$managerRole->id]);
            }
            
            // Create user detail for company manager
            UserDetail::create([
                'user_id' => $companyManager->id,
                'employee_id' => 'MGR' . str_pad($company->id, 3, '0', STR_PAD_LEFT),
                'phone' => '+62' . fake()->numerify('##########'),
                'address' => fake()->address(),
                'department_id' => $managementDept->id,
                'position_id' => $managerPosition->id,
                'join_date' => fake()->dateTimeBetween('-3 years', '-1 year'),
                'status' => 'Active',
                'gender' => fake()->randomElement(['Male', 'Female']),
                'birth_date' => fake()->dateTimeBetween('-50 years', '-30 years'),
                'marital_status' => fake()->randomElement(['Single', 'Married']),
                'emergency_contact_name' => fake()->name(),
                'emergency_contact_relationship' => fake()->randomElement(['Spouse', 'Parent', 'Sibling']),
                'emergency_contact_phone' => '+62' . fake()->numerify('##########'),
                'company_id' => $company->id,
                'branch_id' => $mainBranch->id,
            ]);
            
            // Associate manager with all brands in the company
            foreach ($brands as $brand) {
                DB::table('user_brands')->insert([
                    'user_id' => $companyManager->id,
                    'brand_id' => $brand->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
            
            $totalUsers++;
            
            // Create regular employees (limit to 2-3 per company to keep total users under 50)
            $employeeCount = fake()->numberBetween(2, 3);
            $this->command->info("Creating {$employeeCount} employees for company {$company->name}");
            
            for ($i = 0; $i < $employeeCount; $i++) {
                // Randomly select a branch for this employee
                $branch = $branches->random();
                
                // Randomly select 1-3 brands for this employee
                $selectedBrands = $brands->random(fake()->numberBetween(1, min(3, $brands->count())));
                
                // Create employee
                $employeeName = fake()->name();
                $employeeEmail = strtolower(str_replace(' ', '.', $employeeName)) . "@{$company->domain}";
                
                $employee = User::firstOrCreate(
                    ['email' => $employeeEmail],
                    [
                        'name' => $employeeName,
                        'password' => Hash::make('password'),
                    ]
                );
                
                // Assign employee role
                if ($employeeRole) {
                    $employee->roles()->syncWithoutDetaching([$employeeRole->id]);
                }
                
                // Create or find a department and position for this employee
                $departments = ['HR', 'Finance', 'Operations', 'Marketing', 'Sales', 'IT'];
                $deptName = fake()->randomElement($departments);
                
                $department = Department::firstOrCreate(
                    [
                        'company_id' => $company->id,
                        'name' => $deptName
                    ],
                    [
                        'description' => $deptName . ' Department',
                        'status' => 'active'
                    ]
                );
                
                // Create a default division if it doesn't exist
                $deptDiv = Division::firstOrCreate(
                    [
                        'department_id' => $department->id,
                        'name' => $deptName . ' Division'
                    ],
                    [
                        'description' => $deptName . ' Division',
                        'status' => 'active'
                    ]
                );
                
                // Create a default sub-division if it doesn't exist
                $deptSubDiv = SubDivision::firstOrCreate(
                    [
                        'division_id' => $deptDiv->id,
                        'name' => $deptName . ' Sub-Division'
                    ],
                    [
                        'description' => $deptName . ' Sub-Division',
                        'status' => 'active'
                    ]
                );
                
                // Create or find a level for this employee
                $levels = ['Entry', 'Mid', 'Senior'];
                $levelName = fake()->randomElement($levels);
                
                $level = Level::firstOrCreate(
                    [
                        'company_id' => $company->id,
                        'name' => $levelName
                    ],
                    [
                        'description' => $levelName . ' Level',
                        'level_order' => array_search($levelName, $levels) + 1,
                        'status' => 'active'
                    ]
                );
                
                $positions = [
                    'HR' => ['HR Specialist', 'HR Manager', 'Recruiter'],
                    'Finance' => ['Accountant', 'Financial Analyst', 'Payroll Specialist'],
                    'Operations' => ['Operations Manager', 'Operations Analyst', 'Logistics Coordinator'],
                    'Marketing' => ['Marketing Specialist', 'Content Creator', 'Social Media Manager'],
                    'Sales' => ['Sales Representative', 'Account Manager', 'Sales Coordinator'],
                    'IT' => ['Software Developer', 'IT Support', 'System Administrator']
                ];
                
                $posName = fake()->randomElement($positions[$deptName]);
                
                $position = Position::firstOrCreate(
                    [
                        'company_id' => $company->id,
                        'name' => $posName
                    ],
                    [
                        'description' => $posName . ' Position',
                        'level_id' => $level->id,
                        'sub_division_id' => $deptSubDiv->id,
                        'status' => 'active'
                    ]
                );
                
                // Create user detail for employee
                UserDetail::create([
                    'user_id' => $employee->id,
                    'employee_id' => 'EMP' . str_pad($company->id, 2, '0', STR_PAD_LEFT) . str_pad($i + 1, 3, '0', STR_PAD_LEFT),
                    'phone' => '+62' . fake()->numerify('##########'),
                    'address' => fake()->address(),
                    'department_id' => $department->id,
                    'position_id' => $position->id,
                    'join_date' => fake()->dateTimeBetween('-2 years', 'now'),
                    'status' => fake()->randomElement(['Active', 'On Leave', 'Probation']),
                    'gender' => fake()->randomElement(['Male', 'Female']),
                    'birth_date' => fake()->dateTimeBetween('-45 years', '-20 years'),
                    'marital_status' => fake()->randomElement(['Single', 'Married', 'Divorced']),
                    'emergency_contact_name' => fake()->name(),
                    'emergency_contact_relationship' => fake()->randomElement(['Spouse', 'Parent', 'Sibling', 'Friend']),
                    'emergency_contact_phone' => '+62' . fake()->numerify('##########'),
                    'company_id' => $company->id,
                    'branch_id' => $branch->id,
                ]);
                
                // Associate employee with selected brands
                foreach ($selectedBrands as $brand) {
                    DB::table('user_brands')->insert([
                        'user_id' => $employee->id,
                        'brand_id' => $brand->id,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
                
                $totalUsers++;
                $this->command->info("Created employee {$employeeName} for company {$company->name}");
                
                if ($totalUsers >= 50) {
                    break 2;
                }
            }
            
            $this->command->info("Created {$employeeCount} employees for company {$company->name}");
        }
    }
}
