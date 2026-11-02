<?php

namespace Database\Seeders;

use Database\Seeders\Concerns\TruncatesTablesPortably;
use App\Models\Company;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    use TruncatesTablesPortably;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->clearTables(['roles']);

        // Clear existing roles to avoid duplicates

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
                'description' => 'System administrator with full access to all features',
                'company_id' => $defaultCompany->id,
            ],
            [
                'name' => 'employee',
                'description' => 'Regular employee with access to employee features',
                'company_id' => $defaultCompany->id,
            ],
            [
                'name' => 'manager',
                'description' => 'Manager with access to management features',
                'company_id' => $defaultCompany->id,
            ],
            [
                'name' => 'hr',
                'description' => 'Human Resources personnel with access to HR features',
                'company_id' => $defaultCompany->id,
            ],
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
