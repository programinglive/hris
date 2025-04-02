<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Company;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing roles to avoid duplicates
        DB::statement('PRAGMA foreign_keys = OFF');
        Role::truncate();
        DB::statement('PRAGMA foreign_keys = ON');

        // Create default company if it doesn't exist
        $defaultCompany = \App\Models\Company::firstOrCreate([
            'name' => 'Default Company',
            'code' => 'DEFAU',
            'email' => 'admin@defaultcompany.com',
            'phone' => '+1234567890',
            'is_active' => true,
        ]);

        // Create system roles
        $roles = [
            [
                'name' => 'administrator',
                'display_name' => 'Administrator',
                'description' => 'System administrator with full access to all features',
                'is_system' => true,
                'company_id' => $defaultCompany->id,
            ],
            [
                'name' => 'employee',
                'display_name' => 'Employee',
                'description' => 'Regular employee with access to employee features',
                'is_system' => true,
                'company_id' => $defaultCompany->id,
            ],
            [
                'name' => 'manager',
                'display_name' => 'Manager',
                'description' => 'Manager with access to management features',
                'is_system' => true,
                'company_id' => $defaultCompany->id,
            ],
            [
                'name' => 'hr',
                'display_name' => 'HR Personnel',
                'description' => 'Human Resources personnel with access to HR features',
                'is_system' => true,
                'company_id' => $defaultCompany->id,
            ],
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
