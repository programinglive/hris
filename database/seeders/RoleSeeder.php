<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        
        // Create system roles
        $roles = [
            [
                'name' => 'administrator',
                'display_name' => 'Administrator',
                'description' => 'System administrator with full access to all features',
                'is_system' => true,
            ],
            [
                'name' => 'employee',
                'display_name' => 'Employee',
                'description' => 'Regular employee with access to employee features',
                'is_system' => true,
            ],
            [
                'name' => 'manager',
                'display_name' => 'Manager',
                'description' => 'Manager with access to management features',
                'is_system' => true,
            ],
            [
                'name' => 'hr',
                'display_name' => 'HR Personnel',
                'description' => 'Human Resources personnel with access to HR features',
                'is_system' => true,
            ],
        ];
        
        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
