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
                'code_template' => 'HQ-{company_id}',
                'is_main_branch' => true,
                'city' => 'Jakarta',
                'state' => 'DKI Jakarta',
                'postal_code' => '10110',
                'country' => 'Indonesia',
                'is_active' => true,
            ],
            [
                'name_template' => 'Bandung {company} Branch',
                'code_template' => 'BDG-{company_id}',
                'is_main_branch' => false,
                'city' => 'Bandung',
                'state' => 'West Java',
                'postal_code' => '40111',
                'country' => 'Indonesia',
                'is_active' => true,
            ],
            [
                'name_template' => 'Surabaya {company} Branch',
                'code_template' => 'SRB-{company_id}',
                'is_main_branch' => false,
                'city' => 'Surabaya',
                'state' => 'East Java',
                'postal_code' => '60111',
                'country' => 'Indonesia',
                'is_active' => true,
            ],
            [
                'name_template' => 'Medan {company} Branch',
                'code_template' => 'MDN-{company_id}',
                'is_main_branch' => false,
                'city' => 'Medan',
                'state' => 'North Sumatra',
                'postal_code' => '20111',
                'country' => 'Indonesia',
                'is_active' => true,
            ],
            [
                'name_template' => 'Palembang {company} Branch',
                'code_template' => 'PAL-{company_id}',
                'is_main_branch' => false,
                'city' => 'Palembang',
                'state' => 'South Sumatra',
                'postal_code' => '30111',
                'country' => 'Indonesia',
                'is_active' => true,
            ],
        ];

        // Create branches for each company
        foreach ($branchTemplates as $template) {
            // Create branch for each company
            foreach ($companies as $company) {
                $branch = Branch::create([
                    'name' => str_replace('{company}', $company->name, $template['name_template']),
                    'code' => str_replace(['{company_code}', '{company_id}'], [$company->code, $company->id], $template['code_template']),
                    'address' => fake()->address(),
                    'city' => $template['city'],
                    'state' => $template['state'],
                    'postal_code' => $template['postal_code'],
                    'country' => $template['country'],
                    'phone' => '+62'.fake()->numerify('##########'),
                    'email' => strtolower(str_replace(' ', '.', $template['name_template'])).'@beautyhris.com',
                    'company_id' => $company->id,
                    'is_main_branch' => $template['is_main_branch'],
                    'is_active' => $template['is_active'],
                    'description' => fake()->paragraph(),
                ]);

                $this->command->info("Created branch {$branch->name} for company {$company->name}");
            }
        }
    }
}
