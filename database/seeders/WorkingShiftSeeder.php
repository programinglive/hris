<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\WorkingShift;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class WorkingShiftSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing working shifts to avoid duplicates
        DB::statement('PRAGMA foreign_keys = OFF');
        DB::table('working_shifts')->truncate();
        DB::statement('PRAGMA foreign_keys = ON');
        
        $this->command->info('Seeding working shifts...');
        
        // Get all companies
        $companies = Company::all();
        
        if ($companies->isEmpty()) {
            $this->command->info('No companies found. Please run the CompanySeeder first.');
            return;
        }
        
        // Standard working shifts
        $standardShifts = [
            [
                'name' => 'Morning Shift',
                'code' => 'SHIFT-MOR',
                'start_time' => '08:00',
                'end_time' => '17:00',
                'break_duration' => 60,
                'description' => 'Standard morning shift with 1-hour lunch break',
                'is_active' => true,
            ],
            [
                'name' => 'Afternoon Shift',
                'code' => 'SHIFT-AFT',
                'start_time' => '13:00',
                'end_time' => '22:00',
                'break_duration' => 60,
                'description' => 'Afternoon to evening shift with 1-hour dinner break',
                'is_active' => true,
            ],
            [
                'name' => 'Night Shift',
                'code' => 'SHIFT-NGT',
                'start_time' => '22:00',
                'end_time' => '07:00',
                'break_duration' => 60,
                'description' => 'Overnight shift with 1-hour break',
                'is_active' => true,
            ],
            [
                'name' => 'Half Day Morning',
                'code' => 'SHIFT-HDM',
                'start_time' => '08:00',
                'end_time' => '12:00',
                'break_duration' => 0,
                'description' => 'Half day morning shift with no break',
                'is_active' => true,
            ],
            [
                'name' => 'Half Day Afternoon',
                'code' => 'SHIFT-HDA',
                'start_time' => '13:00',
                'end_time' => '17:00',
                'break_duration' => 0,
                'description' => 'Half day afternoon shift with no break',
                'is_active' => true,
            ],
            [
                'name' => 'Weekend Shift',
                'code' => 'SHIFT-WKD',
                'start_time' => '10:00',
                'end_time' => '16:00',
                'break_duration' => 30,
                'description' => 'Weekend shift with 30-minute break',
                'is_active' => false,
            ],
        ];
        
        // Create working shifts for each company
        foreach ($companies as $index => $company) {
            // Add standard shifts for each company with unique codes
            foreach ($standardShifts as $i => $shift) {
                WorkingShift::create([
                    'name' => $shift['name'],
                    'code' => $shift['code'] . '-' . $company->id,
                    'start_time' => $shift['start_time'],
                    'end_time' => $shift['end_time'],
                    'break_duration' => $shift['break_duration'],
                    'description' => $shift['description'] . ' for ' . $company->name,
                    'is_active' => $shift['is_active'],
                    'company_id' => $company->id,
                ]);
            }
            
            // Add a company-specific custom shift
            WorkingShift::create([
                'name' => $company->name . ' Custom Shift',
                'code' => 'SHIFT-CUSTOM-' . $company->id,
                'start_time' => '09:00',
                'end_time' => '18:00',
                'break_duration' => 45,
                'description' => 'Custom shift for ' . $company->name . ' with 45-minute break',
                'is_active' => true,
                'company_id' => $company->id,
            ]);
        }
        
        $this->command->info('Working shifts seeded successfully!');
    }
}
