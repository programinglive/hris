<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Department;
use App\Models\Division;
use App\Models\Level;
use App\Models\Position;
use App\Models\Role;
use App\Models\SubDivision;
use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
        if (! $firstCompany) {
            throw new \Exception('No company found');
        }

        $itDepartment = Department::firstOrCreate([
            'name' => 'IT',
            'company_id' => $firstCompany->id,
        ], [
            'description' => 'Information Technology Department',
            'company_id' => $firstCompany->id,
            'is_active' => true,
        ]);

        $defaultLevel = Level::firstOrCreate([
            'name' => 'Executive',
            'company_id' => $firstCompany->id,
        ], [
            'description' => 'Executive Level',
            'level_order' => 1,
            'is_active' => true,
            'company_id' => $firstCompany->id,
        ]);

        // Create a default division for IT
        $itDivision = Division::firstOrCreate([
            'name' => 'IT Management',
            'department_id' => $itDepartment->id,
        ], [
            'description' => 'IT Management Division',
            'is_active' => true,
            'department_id' => $itDepartment->id,
        ]);

        // Create a default sub-division for IT
        $itSubDivision = SubDivision::firstOrCreate([
            'name' => 'System Administration',
            'division_id' => $itDivision->id,
        ], [
            'description' => 'System Administration Sub-Division',
            'is_active' => true,
            'division_id' => $itDivision->id,
        ]);

        $adminPosition = Position::firstOrCreate([
            'name' => 'System Administrator',
            'company_id' => $firstCompany->id,
            'department_id' => $itDepartment->id,
            'division_id' => $itDivision->id,
            'sub_division_id' => $itSubDivision->id,
        ], [
            'description' => 'System Administrator',
            'level_id' => $defaultLevel->id,
            'is_active' => true,
            'company_id' => $firstCompany->id,
            'department_id' => $itDepartment->id,
            'division_id' => $itDivision->id,
            'sub_division_id' => $itSubDivision->id,
        ]);

        // Step 5: Seed other tables
        $this->call([
            DepartmentSeeder::class,
            DivisionSeeder::class,
            SubDivisionSeeder::class,
            LevelSeeder::class,
            PositionSeeder::class,
            FaqSeeder::class,
            WorkingCalendarSeeder::class,
            HolidaySeeder::class,
        ]);

        // Step 6: Associate the test user with the first company
        if ($testUser) {
            // Get the first company and its IT department
            $firstCompany = Company::with([
                'departments' => function ($query) {
                    $query->with([
                        'divisions' => function ($query) {
                            $query->with(['subDivisions']);
                        },
                    ]);
                },
                'levels',
            ])->first();

            if (! $firstCompany) {
                throw new \Exception('No company found');
            }

            // Find the IT department with divisions and sub-divisions
            $itDepartment = $firstCompany->departments->first(function ($department) {
                if ($department->divisions->isEmpty()) {
                    return false;
                }

                $firstDivision = $department->divisions->first();
                if (! $firstDivision || $firstDivision->subDivisions->isEmpty()) {
                    return false;
                }

                return true;
            });

            if (! $itDepartment) {
                throw new \Exception('No IT department found with divisions and sub-divisions');
            }

            // Get the default level
            $defaultLevel = $firstCompany->levels->first();
            if (! $defaultLevel) {
                throw new \Exception('No level found for company');
            }

            // Create user details
            UserDetail::create([
                'user_id' => $testUser->id,
                'employee_code' => 'EMP-'.str_pad($testUser->id, 6, '0', STR_PAD_LEFT),
                'status' => 'active',
                'primary_company_id' => $firstCompany->id,
                'branch_id' => $firstCompany->branches->first()->id ?? null,
                'department_id' => $itDepartment->id,
                'division_id' => $itDepartment->divisions->first()->id,
                'sub_division_id' => $itDepartment->divisions->first()->subDivisions->first()->id,
                'level_id' => $defaultLevel->id,
                'join_date' => now(),
            ]);

            // Assign admin role to test user
            if (Role::where('name', 'admin')->exists()) {
                $testUser->assignRole('admin');
            }
        }
    }
}
