<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Department;
use App\Models\Division;
use App\Models\SubDivision;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing departments to avoid duplicates
        DB::statement('PRAGMA foreign_keys = OFF');
        Department::truncate();
        Division::truncate();
        SubDivision::truncate();
        DB::statement('PRAGMA foreign_keys = ON');

        // Get all companies
        $companies = Company::all();

        // Sample departments for each company
        $departmentTemplates = [
            [
                'name' => 'Human Resources',
                'description' => 'Responsible for recruiting, onboarding, training, and employee relations',
                'code' => 'HUM-001',
                'divisions' => [
                    [
                        'name' => 'Recruitment',
                        'description' => 'Responsible for hiring and onboarding new employees',
                        'code' => 'REC-001',
                        'sub_divisions' => [
                            [
                                'name' => 'Sourcing',
                                'description' => 'Responsible for finding qualified candidates',
                                'code' => 'SRC-001',
                            ],
                            [
                                'name' => 'Interviewing',
                                'description' => 'Responsible for conducting interviews',
                                'code' => 'INT-001',
                            ],
                        ],
                    ],
                    [
                        'name' => 'Employee Relations',
                        'description' => 'Responsible for maintaining positive employee relationships',
                        'code' => 'EMP-001',
                        'sub_divisions' => [
                            [
                                'name' => 'Benefits',
                                'description' => 'Responsible for managing employee benefits',
                                'code' => 'BEN-001',
                            ],
                            [
                                'name' => 'Training',
                                'description' => 'Responsible for employee training programs',
                                'code' => 'TRN-001',
                            ],
                        ],
                    ],
                ],
            ],
            [
                'name' => 'Finance',
                'description' => 'Responsible for financial planning, management, and reporting',
                'code' => 'FIN-001',
                'divisions' => [
                    [
                        'name' => 'Accounting',
                        'description' => 'Responsible for financial transactions and reporting',
                        'code' => 'ACC-001',
                        'sub_divisions' => [
                            [
                                'name' => 'Accounts Payable',
                                'description' => 'Responsible for paying invoices',
                                'code' => 'AP-001',
                            ],
                            [
                                'name' => 'Accounts Receivable',
                                'description' => 'Responsible for collecting payments',
                                'code' => 'AR-001',
                            ],
                        ],
                    ],
                    [
                        'name' => 'Budgeting',
                        'description' => 'Responsible for financial planning and budgeting',
                        'code' => 'BUD-001',
                        'sub_divisions' => [
                            [
                                'name' => 'Forecasting',
                                'description' => 'Responsible for financial forecasting',
                                'code' => 'FOR-001',
                            ],
                            [
                                'name' => 'Analysis',
                                'description' => 'Responsible for financial analysis',
                                'code' => 'ANA-001',
                            ],
                        ],
                    ],
                ],
            ],
            [
                'name' => 'Information Technology',
                'description' => 'Responsible for technology infrastructure and software development',
                'code' => 'IT-001',
                'divisions' => [
                    [
                        'name' => 'Infrastructure',
                        'description' => 'Responsible for IT infrastructure',
                        'code' => 'INF-001',
                        'sub_divisions' => [
                            [
                                'name' => 'Network',
                                'description' => 'Responsible for network infrastructure',
                                'code' => 'NET-001',
                            ],
                            [
                                'name' => 'Servers',
                                'description' => 'Responsible for server management',
                                'code' => 'SRV-001',
                            ],
                        ],
                    ],
                    [
                        'name' => 'Development',
                        'description' => 'Responsible for software development',
                        'code' => 'DEV-001',
                        'sub_divisions' => [
                            [
                                'name' => 'Frontend',
                                'description' => 'Responsible for frontend development',
                                'code' => 'FRT-001',
                            ],
                            [
                                'name' => 'Backend',
                                'description' => 'Responsible for backend development',
                                'code' => 'BCK-001',
                            ],
                        ],
                    ],
                ],
            ],
        ];

        foreach ($companies as $company) {
            // Limit to first 3 companies to reduce total number of departments
            if ($company->id > 3) {
                continue;
            }

            DB::transaction(function () use ($company, $departmentTemplates) {
                try {
                    foreach ($departmentTemplates as $template) {
                        // Create unique code by combining company ID with department code
                        $uniqueCode = $company->id.'-'.$template['code'];

                        $department = Department::create([
                            'name' => $template['name'],
                            'description' => $template['description'],
                            'company_id' => $company->id,
                            'is_active' => true,
                            'code' => $uniqueCode,
                        ]);

                        $this->command->info("Created department {$department->name} for company {$company->name}");

                        // Create divisions for the department
                        foreach ($template['divisions'] as $divisionTemplate) {
                            $divisionCode = $department->code.'-'.$divisionTemplate['code'];

                            $division = Division::create([
                                'name' => $divisionTemplate['name'],
                                'description' => $divisionTemplate['description'],
                                'department_id' => $department->id,
                                'is_active' => true,
                                'code' => $divisionCode,
                            ]);

                            $this->command->info("Created division {$division->name} for department {$department->name}");

                            // Create sub-divisions for the division
                            foreach ($divisionTemplate['sub_divisions'] as $subDivisionTemplate) {
                                $subDivisionCode = $division->code.'-'.$subDivisionTemplate['code'];

                                $subDivision = SubDivision::create([
                                    'name' => $subDivisionTemplate['name'],
                                    'description' => $subDivisionTemplate['description'],
                                    'division_id' => $division->id,
                                    'is_active' => true,
                                    'code' => $subDivisionCode,
                                ]);

                                $this->command->info("Created sub-division {$subDivision->name} for division {$division->name}");
                            }
                        }
                    }
                } catch (\Exception $e) {
                    $this->command->error("Error creating departments for company {$company->name}: ".$e->getMessage());
                    throw $e;
                }
            });
        }
    }
}
