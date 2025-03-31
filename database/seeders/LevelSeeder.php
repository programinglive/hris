<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Level;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing levels to avoid duplicates
        DB::statement('PRAGMA foreign_keys = OFF');
        Level::truncate();
        DB::statement('PRAGMA foreign_keys = ON');

        // Get all companies
        $companies = Company::all();

        // Level templates
        $levelTemplates = [
            ['name' => 'Entry', 'description' => 'Entry level position', 'level_order' => 1],
            ['name' => 'Junior', 'description' => 'Junior level position', 'level_order' => 2],
            ['name' => 'Associate', 'description' => 'Associate level position', 'level_order' => 3],
            ['name' => 'Mid', 'description' => 'Mid level position', 'level_order' => 4],
            ['name' => 'Senior', 'description' => 'Senior level position', 'level_order' => 5],
            ['name' => 'Lead', 'description' => 'Lead level position', 'level_order' => 6],
            ['name' => 'Manager', 'description' => 'Manager level position', 'level_order' => 7],
            ['name' => 'Director', 'description' => 'Director level position', 'level_order' => 8],
            ['name' => 'VP', 'description' => 'Vice President level position', 'level_order' => 9],
            ['name' => 'C-Level', 'description' => 'C-Level executive position', 'level_order' => 10],
        ];

        foreach ($companies as $company) {
            // Create levels for this company
            foreach ($levelTemplates as $template) {
                $level = Level::create([
                    'name' => $template['name'],
                    'description' => $template['description'],
                    'level_order' => $template['level_order'],
                    'company_id' => $company->id,
                    'is_active' => true,
                ]);

                $this->command->info("Created level {$level->name} for company {$company->name}");
            }
        }
    }
}
