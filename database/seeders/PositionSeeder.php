<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Level;
use App\Models\Position;
use App\Models\SubDivision;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing positions to avoid duplicates
        DB::statement('PRAGMA foreign_keys = OFF');
        Position::truncate();
        DB::statement('PRAGMA foreign_keys = ON');
        
        // Position templates by sub-division name - limited to fewer sub-divisions
        $positionTemplates = [
            // HR Sub-divisions
            'Talent Acquisition' => ['Recruiter', 'Sourcing Specialist'],
            'Professional Development' => ['Training Coordinator', 'Learning Specialist'],
            
            // Finance Sub-divisions
            'Accounts Payable' => ['AP Clerk', 'AP Specialist'],
            'Budgeting' => ['Budget Analyst', 'Financial Analyst'],
            
            // IT Sub-divisions
            'Frontend Development' => ['Frontend Developer', 'UI Developer'],
            'Backend Development' => ['Backend Developer', 'API Developer'],
            
            // Customer Service Sub-divisions
            'Inbound' => ['Customer Service Representative', 'Customer Support Specialist'],
            
            // Sales Sub-divisions
            'Field Sales' => ['Field Sales Representative', 'Territory Manager'],
        ];
        
        // Get all sub-divisions
        $subDivisions = SubDivision::all();
        
        // Counter to limit the number of positions created
        $positionCount = 0;
        $maxPositions = 50;
        
        // Get a limited set of sub-divisions to work with
        $limitedSubDivisions = $subDivisions->filter(function ($subDivision) use ($positionTemplates) {
            return array_key_exists($subDivision->name, $positionTemplates);
        })->take(10);
        
        foreach ($limitedSubDivisions as $subDivision) {
            // Break if we've reached the maximum number of positions
            if ($positionCount >= $maxPositions) {
                $this->command->info("Maximum number of positions ({$maxPositions}) reached. Stopping position creation.");
                break;
            }
            
            // Get company ID from the sub-division's division's department
            $division = $subDivision->division;
            if (!$division) {
                $this->command->info("No division found for sub-division {$subDivision->name}. Skipping position creation.");
                continue;
            }
            
            $department = $division->department;
            if (!$department) {
                $this->command->info("No department found for division {$division->name}. Skipping position creation.");
                continue;
            }
            
            $companyId = $department->company_id;
            if (!$companyId) {
                $this->command->info("No company found for department {$department->name}. Skipping position creation.");
                continue;
            }
            
            // Get levels for this company - limit to 3 levels max
            $levels = Level::where('company_id', $companyId)->orderBy('level_order')->take(3)->get();
            if ($levels->isEmpty()) {
                $this->command->info("No levels found for company ID {$companyId}. Skipping position creation.");
                continue;
            }
            
            // Get position templates for this sub-division
            $templates = $positionTemplates[$subDivision->name] ?? [];
            
            if (empty($templates)) {
                $this->command->info("No position templates found for sub-division {$subDivision->name}. Skipping position creation.");
                continue;
            }
            
            // Create positions for this sub-division with different levels
            foreach ($templates as $positionName) {
                // Create the position for only 2 levels to limit the number of positions
                foreach ($levels->take(2) as $level) {
                    // Break if we've reached the maximum number of positions
                    if ($positionCount >= $maxPositions) {
                        break 3; // Break out of all loops
                    }
                    
                    // Calculate salary range based on level order
                    $baseSalary = 30000 + ($level->level_order * 10000); // Base salary increases with level order
                    $minSalary = $baseSalary - ($baseSalary * 0.1); // 10% below base
                    $maxSalary = $baseSalary + ($baseSalary * 0.2); // 20% above base
                    
                    $position = Position::create([
                        'name' => $positionName,
                        'description' => "A {$level->name} level {$positionName} position in the {$subDivision->name} sub-division",
                        'level_id' => $level->id,
                        'sub_division_id' => $subDivision->id,
                        'company_id' => $companyId,
                        'min_salary' => $minSalary,
                        'max_salary' => $maxSalary,
                        'status' => 'active',
                    ]);
                    
                    $positionCount++;
                    $this->command->info("Created position {$positionCount}/{$maxPositions}: {$level->name} {$position->name} for sub-division {$subDivision->name}");
                }
            }
        }
        
        $this->command->info("Created a total of {$positionCount} positions.");
    }
}
