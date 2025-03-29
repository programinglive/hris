<?php

namespace Database\Seeders;

use App\Models\Branch;
use App\Models\Company;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing branches to avoid duplicates
        DB::statement('PRAGMA foreign_keys = OFF');
        Branch::truncate();
        DB::statement('PRAGMA foreign_keys = ON');
        
        // Get all companies
        $companies = Company::all();
        
        if ($companies->isEmpty()) {
            // This should not happen as CompanySeeder should have been run first
            $this->command->info('No companies found. Please run CompanySeeder first.');
            return;
        }
        
        // Branch templates - we'll customize these for each company
        $branchTemplates = [
            [
                'name_template' => '{company} Headquarters',
                'code_template' => 'HQ-{company_code}',
                'is_main_branch' => true,
                'city' => 'Jakarta',
                'state' => 'DKI Jakarta',
                'postal_code' => '10110',
                'country' => 'Indonesia',
                'is_active' => true,
            ],
            [
                'name_template' => 'Bandung {company} Branch',
                'code_template' => 'BDG-{company_code}',
                'is_main_branch' => false,
                'city' => 'Bandung',
                'state' => 'West Java',
                'postal_code' => '40111',
                'country' => 'Indonesia',
                'is_active' => true,
            ],
            [
                'name_template' => 'Surabaya {company} Branch',
                'code_template' => 'SBY-{company_code}',
                'is_main_branch' => false,
                'city' => 'Surabaya',
                'state' => 'East Java',
                'postal_code' => '60111',
                'country' => 'Indonesia',
                'is_active' => true,
            ],
            [
                'name_template' => 'Bali {company} Branch',
                'code_template' => 'BAL-{company_code}',
                'is_main_branch' => false,
                'city' => 'Denpasar',
                'state' => 'Bali',
                'postal_code' => '80361',
                'country' => 'Indonesia',
                'is_active' => true,
            ],
        ];
        
        // Create branches for each company
        foreach ($companies as $company) {
            // Extract company code from name or use first 3 letters
            $companyCode = preg_match('/^[A-Za-z\s]+/', $company->name, $matches)
                ? strtoupper(substr(preg_replace('/\s+/', '', $matches[0]), 0, 3))
                : strtoupper(substr($company->name, 0, 3));
            
            foreach ($branchTemplates as $index => $template) {
                $name = str_replace('{company}', $company->name, $template['name_template']);
                $code = str_replace('{company_code}', $companyCode, $template['code_template']) . '-' . sprintf('%03d', $index + 1);
                
                // Create branch with company relationship
                Branch::create([
                    'name' => $name,
                    'code' => $code,
                    'address' => $template['is_main_branch'] 
                        ? $company->address 
                        : fake()->streetAddress() . ', ' . $template['city'],
                    'city' => $template['city'],
                    'state' => $template['state'],
                    'postal_code' => $template['postal_code'],
                    'country' => $template['country'],
                    'phone' => '+62' . fake()->numerify('##########'),
                    'email' => strtolower(substr($template['city'], 0, 3)) . '.' . strtolower($companyCode) . '@' . fake()->domainName(),
                    'company_id' => $company->id,
                    'is_main_branch' => $template['is_main_branch'],
                    'is_active' => $template['is_active'],
                    'description' => $template['is_main_branch'] 
                        ? 'Main headquarters for ' . $company->name 
                        : $template['city'] . ' branch office for ' . $company->name,
                ]);
            }
            
            // Add 1-2 random branches per company
            $randomBranchCount = rand(1, 2);
            Branch::factory()
                ->count($randomBranchCount)
                ->create([
                    'company_id' => $company->id,
                    'is_main_branch' => false, // Random branches are never main branches
                ]);
        }
    }
}
