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
                'employee_code' => 'MGR' . str_pad($company->id, 3, '0', STR_PAD_LEFT),
                'status' => 'active',
                'company_id' => $company->id,
                'branch_id' => $mainBranch->id,
                'department_id' => $managementDept->id,
                'division_id' => $managementDiv->id,
                'sub_division_id' => $managementSubDiv->id,
                'level_id' => $executiveLevel->id,
                'position_id' => $managerPosition->id,
                'join_date' => now(),
            ]);

            // Create user brands for company manager
            foreach ($brands as $brand) {
                UserBrand::create([
                    'user_id' => $companyManager->id,
                    'brand_id' => $brand->id,
                ]);
            }

            $totalUsers++;

            // Create regular employees (3 per company)
            for ($i = 1; $i <= 3; $i++) {
                $email = "employee" . $i . "@" . strtolower(str_replace(' ', '', $company->name)) . ".com";
                $user = User::firstOrCreate([
                    'email' => $email,
                ], [
                    'name' => "Employee {$i} at {$company->name}",
                    'password' => Hash::make('password'),
                ]);

                if ($employeeRole) {
                    $user->roles()->syncWithoutDetaching([$employeeRole->id]);
                }

                // Create user detail for employee
                UserDetail::create([
                    'user_id' => $user->id,
                    'employee_code' => 'EMP' . str_pad($company->id, 3, '0', STR_PAD_LEFT) . str_pad($i, 2, '0', STR_PAD_LEFT),
                    'status' => 'active',
                    'company_id' => $company->id,
                    'branch_id' => $mainBranch->id,
                    'department_id' => $managementDept->id,
                    'division_id' => $managementDiv->id,
                    'sub_division_id' => $managementSubDiv->id,
                    'level_id' => $executiveLevel->id,
                    'position_id' => $managerPosition->id,
                    'join_date' => now(),
                ]);

                // Create user brands for employee
                foreach ($brands as $brand) {
                    UserBrand::create([
                        'user_id' => $user->id,
                        'brand_id' => $brand->id,
                    ]);
                }

                $totalUsers++;
            }
        }

        $this->command->info("Created {$totalUsers} users with their details and relationships.");
    }
}
