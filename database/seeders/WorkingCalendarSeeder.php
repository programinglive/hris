<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\WorkingCalendar;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WorkingCalendarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing working calendars to avoid duplicates
        DB::statement('PRAGMA foreign_keys = OFF');
        WorkingCalendar::truncate();
        DB::statement('PRAGMA foreign_keys = ON');

        $this->command->info('Seeding working calendars...');

        // Get all companies
        $companies = Company::all();

        if ($companies->isEmpty()) {
            $this->command->info('No companies found. Please run the CompanySeeder first.');

            return;
        }

        // Create working calendars for each company
        foreach ($companies as $company) {
            // Create a working calendar for the current year
            $currentYear = Carbon::now()->year;

            // Current year working calendar
            WorkingCalendar::create([
                'name' => "Working Calendar {$currentYear}",
                'start_date' => Carbon::create($currentYear, 1, 1),
                'end_date' => Carbon::create($currentYear, 12, 31),
                'description' => "Standard working calendar for {$company->name} for the year {$currentYear}",
                'is_active' => true,
                'company_id' => $company->id,
            ]);

            // Next year working calendar
            WorkingCalendar::create([
                'name' => 'Working Calendar '.($currentYear + 1),
                'start_date' => Carbon::create($currentYear + 1, 1, 1),
                'end_date' => Carbon::create($currentYear + 1, 12, 31),
                'description' => "Standard working calendar for {$company->name} for the year ".($currentYear + 1),
                'is_active' => false,
                'company_id' => $company->id,
            ]);

            // Previous year working calendar
            WorkingCalendar::create([
                'name' => 'Working Calendar '.($currentYear - 1),
                'start_date' => Carbon::create($currentYear - 1, 1, 1),
                'end_date' => Carbon::create($currentYear - 1, 12, 31),
                'description' => "Standard working calendar for {$company->name} for the year ".($currentYear - 1),
                'is_active' => false,
                'company_id' => $company->id,
            ]);

            // First quarter working calendar
            WorkingCalendar::create([
                'name' => "Q1 {$currentYear}",
                'start_date' => Carbon::create($currentYear, 1, 1),
                'end_date' => Carbon::create($currentYear, 3, 31),
                'description' => "First quarter working calendar for {$company->name}",
                'is_active' => true,
                'company_id' => $company->id,
            ]);

            // Second quarter working calendar
            WorkingCalendar::create([
                'name' => "Q2 {$currentYear}",
                'start_date' => Carbon::create($currentYear, 4, 1),
                'end_date' => Carbon::create($currentYear, 6, 30),
                'description' => "Second quarter working calendar for {$company->name}",
                'is_active' => true,
                'company_id' => $company->id,
            ]);

            // Third quarter working calendar
            WorkingCalendar::create([
                'name' => "Q3 {$currentYear}",
                'start_date' => Carbon::create($currentYear, 7, 1),
                'end_date' => Carbon::create($currentYear, 9, 30),
                'description' => "Third quarter working calendar for {$company->name}",
                'is_active' => true,
                'company_id' => $company->id,
            ]);

            // Fourth quarter working calendar
            WorkingCalendar::create([
                'name' => "Q4 {$currentYear}",
                'start_date' => Carbon::create($currentYear, 10, 1),
                'end_date' => Carbon::create($currentYear, 12, 31),
                'description' => "Fourth quarter working calendar for {$company->name}",
                'is_active' => true,
                'company_id' => $company->id,
            ]);
        }

        $this->command->info('Working calendars seeded successfully!');
    }
}
