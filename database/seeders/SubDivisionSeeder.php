<?php

namespace Database\Seeders;

use App\Models\Division;
use App\Models\SubDivision;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubDivisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing sub-divisions to avoid duplicates
        DB::statement('PRAGMA foreign_keys = OFF');
        SubDivision::truncate();
        DB::statement('PRAGMA foreign_keys = ON');
        
        // Get all divisions
        $divisions = Division::all();
        
        // Sub-division templates by division name
        $subDivisionTemplates = [
            // HR Divisions
            'Recruitment' => [
                ['name' => 'Talent Acquisition', 'description' => 'Responsible for sourcing and attracting candidates'],
                ['name' => 'Interviewing', 'description' => 'Responsible for candidate assessment and selection'],
            ],
            'Training & Development' => [
                ['name' => 'Onboarding', 'description' => 'Responsible for new employee orientation'],
                ['name' => 'Professional Development', 'description' => 'Responsible for ongoing employee skill development'],
            ],
            'Employee Relations' => [
                ['name' => 'Conflict Resolution', 'description' => 'Responsible for addressing workplace conflicts'],
                ['name' => 'Employee Engagement', 'description' => 'Responsible for promoting positive workplace culture'],
            ],
            
            // Finance Divisions
            'Accounting' => [
                ['name' => 'Accounts Payable', 'description' => 'Responsible for managing outgoing payments'],
                ['name' => 'Accounts Receivable', 'description' => 'Responsible for managing incoming payments'],
            ],
            'Payroll' => [
                ['name' => 'Compensation', 'description' => 'Responsible for salary and wage administration'],
                ['name' => 'Benefits', 'description' => 'Responsible for employee benefits administration'],
            ],
            'Financial Planning' => [
                ['name' => 'Budgeting', 'description' => 'Responsible for budget creation and monitoring'],
                ['name' => 'Forecasting', 'description' => 'Responsible for financial projections'],
            ],
            
            // Operations Divisions
            'Production' => [
                ['name' => 'Manufacturing', 'description' => 'Responsible for product creation'],
                ['name' => 'Assembly', 'description' => 'Responsible for product assembly'],
            ],
            'Quality Assurance' => [
                ['name' => 'Testing', 'description' => 'Responsible for product testing'],
                ['name' => 'Quality Control', 'description' => 'Responsible for maintaining quality standards'],
            ],
            'Supply Chain' => [
                ['name' => 'Procurement', 'description' => 'Responsible for purchasing materials and supplies'],
                ['name' => 'Logistics', 'description' => 'Responsible for transportation and distribution'],
            ],
            
            // Marketing Divisions
            'Digital Marketing' => [
                ['name' => 'Social Media', 'description' => 'Responsible for social media marketing'],
                ['name' => 'SEO', 'description' => 'Responsible for search engine optimization'],
            ],
            'Brand Management' => [
                ['name' => 'Brand Identity', 'description' => 'Responsible for visual brand elements'],
                ['name' => 'Brand Strategy', 'description' => 'Responsible for brand positioning and messaging'],
            ],
            'Market Research' => [
                ['name' => 'Consumer Insights', 'description' => 'Responsible for understanding customer behavior'],
                ['name' => 'Competitive Analysis', 'description' => 'Responsible for analyzing competitors'],
            ],
            
            // IT Divisions
            'Software Development' => [
                ['name' => 'Frontend Development', 'description' => 'Responsible for user interface development'],
                ['name' => 'Backend Development', 'description' => 'Responsible for server-side development'],
            ],
            'Infrastructure' => [
                ['name' => 'Network', 'description' => 'Responsible for network management'],
                ['name' => 'Systems', 'description' => 'Responsible for server and system management'],
            ],
            'IT Support' => [
                ['name' => 'Helpdesk', 'description' => 'Responsible for first-line technical support'],
                ['name' => 'Desktop Support', 'description' => 'Responsible for hardware and software support'],
            ],
            
            // Customer Service Divisions
            'Call Center' => [
                ['name' => 'Inbound', 'description' => 'Responsible for handling incoming customer calls'],
                ['name' => 'Outbound', 'description' => 'Responsible for proactive customer outreach'],
            ],
            'Online Support' => [
                ['name' => 'Chat Support', 'description' => 'Responsible for live chat customer support'],
                ['name' => 'Email Support', 'description' => 'Responsible for email-based customer support'],
            ],
            'Customer Experience' => [
                ['name' => 'Customer Feedback', 'description' => 'Responsible for collecting and analyzing customer feedback'],
                ['name' => 'Service Improvement', 'description' => 'Responsible for enhancing customer service processes'],
            ],
            
            // Sales Divisions
            'Direct Sales' => [
                ['name' => 'Field Sales', 'description' => 'Responsible for in-person sales activities'],
                ['name' => 'Inside Sales', 'description' => 'Responsible for remote sales activities'],
            ],
            'Account Management' => [
                ['name' => 'Key Accounts', 'description' => 'Responsible for managing major client relationships'],
                ['name' => 'Client Success', 'description' => 'Responsible for client satisfaction and retention'],
            ],
            'Business Development' => [
                ['name' => 'Market Expansion', 'description' => 'Responsible for entering new markets'],
                ['name' => 'Strategic Partnerships', 'description' => 'Responsible for developing business alliances'],
            ],
        ];
        
        foreach ($divisions as $division) {
            // Get users from the same company as the division manager
            $divisionManager = $division->manager;
            if (!$divisionManager || !$divisionManager->detail || !$divisionManager->detail->company_id) {
                $this->command->info("No valid manager found for division {$division->name}. Skipping sub-division creation.");
                continue;
            }
            
            $companyId = $divisionManager->detail->company_id;
            $users = User::whereHas('detail', function ($query) use ($companyId) {
                $query->where('company_id', $companyId);
            })->get();
            
            if ($users->isEmpty()) {
                $this->command->info("No users found for division {$division->name}. Skipping sub-division creation.");
                continue;
            }
            
            // Get sub-division templates for this division
            $templates = $subDivisionTemplates[$division->name] ?? [];
            
            // Create sub-divisions for this division
            foreach ($templates as $template) {
                // Assign a random user as manager
                $manager = $users->random();
                
                $subDivision = SubDivision::create([
                    'name' => $template['name'],
                    'description' => $template['description'],
                    'division_id' => $division->id,
                    'manager_id' => $manager->id,
                    'status' => 'active',
                ]);
                
                $this->command->info("Created sub-division {$subDivision->name} for division {$division->name}");
            }
        }
    }
}
