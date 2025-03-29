<?php

namespace Tests\Fixtures;

use App\Models\Branch;
use App\Models\Company;
use App\Models\User;
use Spatie\SimpleExcel\SimpleExcelWriter;

class TestDepartmentExcelGenerator
{
    /**
     * Create a valid department import test file
     *
     * @return string Path to the generated file
     */
    public static function createValidFile(): string
    {
        $filePath = storage_path('app/public/templates/test_department_import.xlsx');
        
        // Ensure the directory exists
        if (!file_exists(dirname($filePath))) {
            mkdir(dirname($filePath), 0755, true);
        }
        
        // Create a company and branch specifically for this test
        // This ensures we have valid IDs that exist in the test database
        $user = User::first() ?? User::factory()->create();
        $company = Company::first() ?? Company::factory()->create(['owner_id' => $user->id]);
        $branch = Branch::where('company_id', $company->id)->first() ?? 
                 Branch::factory()->create(['company_id' => $company->id]);
        
        $writer = SimpleExcelWriter::create($filePath);
        
        // Add headers
        $writer->addRow([
            'name' => 'name',
            'description' => 'description',
            'company_id' => 'company_id',
            'branch_id' => 'branch_id',
            'manager_id' => 'manager_id',
            'status' => 'status'
        ]);
        
        // Add test data with valid company_id and branch_id
        $writer->addRow([
            'name' => 'Test Department 1',
            'description' => 'Test Department 1 Description',
            'company_id' => $company->id,
            'branch_id' => $branch->id,
            'manager_id' => '',
            'status' => 'active'
        ]);
        
        $writer->addRow([
            'name' => 'Test Department 2',
            'description' => 'Test Department 2 Description',
            'company_id' => $company->id,
            'branch_id' => $branch->id, // Ensure this has a valid branch_id
            'manager_id' => '',
            'status' => 'active'
        ]);
        
        $writer->addRow([
            'name' => 'Test Department 3',
            'description' => 'Test Department 3 Description',
            'company_id' => $company->id,
            'branch_id' => $branch->id,
            'manager_id' => '',
            'status' => 'inactive'
        ]);
        
        $writer->close();
        
        return $filePath;
    }
    
    /**
     * Create an invalid department import test file
     *
     * @return string Path to the generated file
     */
    public static function createInvalidFile(): string
    {
        $filePath = storage_path('app/public/templates/invalid_department_import.xlsx');
        
        // Ensure the directory exists
        if (!file_exists(dirname($filePath))) {
            mkdir(dirname($filePath), 0755, true);
        }
        
        // Get valid company and branch IDs for reference
        $user = User::first() ?? User::factory()->create();
        $company = Company::first() ?? Company::factory()->create(['owner_id' => $user->id]);
        $branch = Branch::where('company_id', $company->id)->first() ?? 
                 Branch::factory()->create(['company_id' => $company->id]);
        
        $writer = SimpleExcelWriter::create($filePath);
        
        // Add headers
        $writer->addRow([
            'name' => 'name',
            'description' => 'description',
            'company_id' => 'company_id',
            'branch_id' => 'branch_id',
            'manager_id' => 'manager_id',
            'status' => 'status'
        ]);
        
        // Add invalid test data (missing required company_id)
        $writer->addRow([
            'name' => 'Invalid Department 1',
            'description' => 'Invalid Department 1 Description',
            'company_id' => '',
            'branch_id' => $branch->id,
            'manager_id' => '',
            'status' => 'active'
        ]);
        
        // Add invalid test data (invalid status)
        $writer->addRow([
            'name' => 'Invalid Department 2',
            'description' => 'Invalid Department 2 Description',
            'company_id' => $company->id,
            'branch_id' => $branch->id,
            'manager_id' => '',
            'status' => 'invalid_status'
        ]);
        
        $writer->close();
        
        return $filePath;
    }
}
