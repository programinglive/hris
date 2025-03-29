<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Holiday;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class HolidaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing holidays to avoid duplicates
        DB::statement('PRAGMA foreign_keys = OFF');
        Holiday::truncate();
        DB::statement('PRAGMA foreign_keys = ON');
        
        $this->command->info('Seeding holidays...');
        
        // Get all companies
        $companies = Company::all();
        
        if ($companies->isEmpty()) {
            $this->command->info('No companies found. Please run the CompanySeeder first.');
            return;
        }
        
        // National holidays for the current year (Indonesia)
        $currentYear = Carbon::now()->year;
        $nationalHolidays = [
            [
                'name' => 'New Year\'s Day',
                'date' => Carbon::create($currentYear, 1, 1),
                'description' => 'New Year\'s Day celebration',
                'is_recurring' => true,
            ],
            [
                'name' => 'Chinese New Year',
                'date' => Carbon::create($currentYear, 2, 10), // Date varies each year
                'description' => 'Chinese New Year celebration',
                'is_recurring' => true,
            ],
            [
                'name' => 'Nyepi (Balinese New Year)',
                'date' => Carbon::create($currentYear, 3, 11), // Date varies each year
                'description' => 'Balinese Day of Silence',
                'is_recurring' => true,
            ],
            [
                'name' => 'Good Friday',
                'date' => Carbon::create($currentYear, 3, 29), // Date varies each year
                'description' => 'Christian holiday commemorating the crucifixion of Jesus',
                'is_recurring' => true,
            ],
            [
                'name' => 'Labor Day',
                'date' => Carbon::create($currentYear, 5, 1),
                'description' => 'International Workers\' Day',
                'is_recurring' => true,
            ],
            [
                'name' => 'Eid al-Fitr',
                'date' => Carbon::create($currentYear, 4, 10), // Date varies each year
                'description' => 'Muslim holiday marking the end of Ramadan',
                'is_recurring' => true,
            ],
            [
                'name' => 'Eid al-Fitr Holiday',
                'date' => Carbon::create($currentYear, 4, 11), // Day after Eid al-Fitr
                'description' => 'Additional holiday for Eid al-Fitr',
                'is_recurring' => true,
            ],
            [
                'name' => 'Independence Day',
                'date' => Carbon::create($currentYear, 8, 17),
                'description' => 'Indonesian Independence Day',
                'is_recurring' => true,
            ],
            [
                'name' => 'Eid al-Adha',
                'date' => Carbon::create($currentYear, 6, 17), // Date varies each year
                'description' => 'Muslim holiday of sacrifice',
                'is_recurring' => true,
            ],
            [
                'name' => 'Islamic New Year',
                'date' => Carbon::create($currentYear, 7, 7), // Date varies each year
                'description' => 'Islamic New Year celebration',
                'is_recurring' => true,
            ],
            [
                'name' => 'Christmas Day',
                'date' => Carbon::create($currentYear, 12, 25),
                'description' => 'Christian holiday celebrating the birth of Jesus',
                'is_recurring' => true,
            ],
            [
                'name' => 'Boxing Day',
                'date' => Carbon::create($currentYear, 12, 26),
                'description' => 'Day after Christmas',
                'is_recurring' => true,
            ],
        ];
        
        // Create holidays for each company
        foreach ($companies as $company) {
            // Add national holidays for each company
            foreach ($nationalHolidays as $holiday) {
                Holiday::create([
                    'name' => $holiday['name'],
                    'date' => $holiday['date'],
                    'description' => $holiday['description'],
                    'is_recurring' => $holiday['is_recurring'],
                    'company_id' => $company->id,
                ]);
            }
            
            // Add company-specific holidays
            Holiday::create([
                'name' => 'Company Anniversary',
                'date' => Carbon::create($currentYear, rand(1, 12), rand(1, 28)),
                'description' => "Anniversary of {$company->name}",
                'is_recurring' => true,
                'company_id' => $company->id,
            ]);
            
            Holiday::create([
                'name' => 'Company Retreat',
                'date' => Carbon::create($currentYear, rand(1, 12), rand(1, 28)),
                'description' => "Annual company retreat for {$company->name}",
                'is_recurring' => true,
                'company_id' => $company->id,
            ]);
            
            // Add some random one-time holidays
            for ($i = 0; $i < 3; $i++) {
                $month = rand(1, 12);
                $day = rand(1, 28);
                
                Holiday::create([
                    'name' => "Special Event " . ($i + 1),
                    'date' => Carbon::create($currentYear, $month, $day),
                    'description' => "Special one-time event for {$company->name}",
                    'is_recurring' => false,
                    'company_id' => $company->id,
                ]);
            }
        }
        
        $this->command->info('Holidays seeded successfully!');
    }
}
