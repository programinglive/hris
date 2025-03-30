<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserDetail;
use App\Models\Role;
use App\Models\Department;
use App\Models\Position;
use App\Models\Company;
use App\Models\Division;
use App\Models\Level;
use App\Models\SubDivision;
use Database\Seeders\CompanySeeder;
use Database\Seeders\BranchSeeder;
use Database\Seeders\BrandSeeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\DepartmentSeeder;
use Database\Seeders\DivisionSeeder;
use Database\Seeders\SubDivisionSeeder;
use Database\Seeders\LevelSeeder;
use Database\Seeders\PositionSeeder;
use Database\Seeders\FaqSeeder;
use Database\Seeders\WorkingCalendarSeeder;
use Database\Seeders\HolidaySeeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // For SQLite, we use pragma to disable foreign keys
        DB::statement('PRAGMA foreign_keys = OFF');
        
        // Clear existing data to avoid duplicates
        DB::table('user_brands')->truncate();
        UserDetail::truncate();
        User::truncate();
        DB::statement('PRAGMA foreign_keys = ON');
        
        // Create test user with administrator role
        $testUser = User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('password'),
        ]);
        
        $this->command->info('Seeding basic structure...');
        
        // Step 1: Seed roles
        $this->call(RoleSeeder::class);
        
        // Step 2: Seed companies
        $this->call(CompanySeeder::class);
        
        // Step 3: Seed branches and brands which depend on companies
        $this->call(BranchSeeder::class);
        $this->call(BrandSeeder::class);
        
        // Step 4: Create IT department and System Administrator position if they don't exist
        $firstCompany = Company::first();
        if (!$firstCompany) {
            throw new \Exception('No company found');
        }
        
        $itDepartment = Department::firstOrCreate([
            'name' => 'IT',
            'company_id' => $firstCompany->id
        ], [
            'description' => 'Information Technology Department',
            'company_id' => $firstCompany->id,
            'status' => 'active'
        ]);
        
        $defaultLevel = Level::firstOrCreate([
            'name' => 'Executive',
            'company_id' => $firstCompany->id
        ], [
            'description' => 'Executive Level',
            'level_order' => 1,
            'status' => 'active',
            'company_id' => $firstCompany->id
        ]);
        
        // Create a default division for IT
        $itDivision = Division::firstOrCreate([
            'name' => 'IT Management',
            'department_id' => $itDepartment->id
        ], [
            'description' => 'IT Management Division',
            'status' => 'active',
            'department_id' => $itDepartment->id
        ]);
        
        // Create a default sub-division for IT
        $itSubDivision = SubDivision::firstOrCreate([
            'name' => 'System Administration',
            'division_id' => $itDivision->id
        ], [
            'description' => 'System Administration Sub-Division',
            'status' => 'active',
            'division_id' => $itDivision->id
        ]);
        
        $adminPosition = Position::firstOrCreate([
            'name' => 'System Administrator',
            'company_id' => $firstCompany->id,
            'department_id' => $itDepartment->id,
            'division_id' => $itDivision->id,
            'sub_division_id' => $itSubDivision->id
        ], [
            'description' => 'System Administrator',
            'level_id' => $defaultLevel->id,
            'status' => 'active',
            'company_id' => $firstCompany->id,
            'department_id' => $itDepartment->id,
            'division_id' => $itDivision->id,
            'sub_division_id' => $itSubDivision->id
        ]);
        
        // Step 5: Associate the test user with the first company
        if ($testUser) {
            UserDetail::create([
                'user_id' => $testUser->id,
                'employee_code' => 'EMP-'.str_pad($testUser->id, 6, '0', STR_PAD_LEFT),
                'status' => 'active',
                'company_id' => $firstCompany->id,
                'branch_id' => $firstCompany->branches->first()->id ?? null,
                'department_id' => $itDepartment->id,
                'division_id' => $itDivision->id,
                'sub_division_id' => $itSubDivision->id,
                'level_id' => $defaultLevel->id,
                'position_id' => $adminPosition->id,
                'join_date' => now()
            ]);
            
            // Assign admin role to test user
            if (Role::where('name', 'admin')->exists()) {
                $testUser->assignRole('admin');
            }
        }
        
        // Step 6: Seed other tables
        $this->call([
            DepartmentSeeder::class,
            DivisionSeeder::class,
            SubDivisionSeeder::class,
            LevelSeeder::class,
            PositionSeeder::class,
            FaqSeeder::class,
            WorkingCalendarSeeder::class,
            HolidaySeeder::class
        ]);
    }
}
