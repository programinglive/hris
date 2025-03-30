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
        
        $positions = [
            [
                'name' => 'CEO',
                'description' => 'Chief Executive Officer',
                'company_id' => 1,
                'department_id' => 1,
                'division_id' => 1,
                'sub_division_id' => 1,
                'level_id' => 1,
                'status' => 'active',
            ],
            [
                'name' => 'COO',
                'description' => 'Chief Operating Officer',
                'company_id' => 1,
                'department_id' => 1,
                'division_id' => 1,
                'sub_division_id' => 1,
                'level_id' => 2,
                'status' => 'active',
            ],
            [
                'name' => 'CFO',
                'description' => 'Chief Financial Officer',
                'company_id' => 1,
                'department_id' => 1,
                'division_id' => 1,
                'sub_division_id' => 1,
                'level_id' => 3,
                'status' => 'active',
            ],
            [
                'name' => 'HR Manager',
                'description' => 'Human Resources Manager',
                'company_id' => 1,
                'department_id' => 2,
                'division_id' => 2,
                'sub_division_id' => 2,
                'level_id' => 4,
                'status' => 'active',
            ],
            [
                'name' => 'HR Assistant',
                'description' => 'Human Resources Assistant',
                'company_id' => 1,
                'department_id' => 2,
                'division_id' => 2,
                'sub_division_id' => 2,
                'level_id' => 5,
                'status' => 'active',
            ],
        ];

        foreach ($positions as $position) {
            Position::create($position);
        }
        
        $this->command->info("Created a total of " . count($positions) . " positions.");
    }
}
