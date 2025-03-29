<?php

namespace Tests\Feature\Organization;

use App\Models\Branch;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;
use Spatie\SimpleExcel\SimpleExcelWriter;

class BranchImportTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();
        
        // Create a user and authenticate
        $user = User::factory()->create();
        $this->actingAs($user);
        
        // Create a company for testing
        \App\Models\Company::create([
            'name' => 'Test Company',
            'code' => 'TEST',
            'email' => 'test@company.com',
            'is_active' => true,
            'owner_id' => $user->id // Set the authenticated user as the company owner
        ]);
        
        // Set up storage for file uploads
        Storage::fake('local');
    }

    #[Test]
    public function it_can_download_branch_import_template()
    {
        $response = $this->get(route('organization.branch.import.template'));
        
        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        $response->assertHeader('Content-Disposition', 'attachment; filename=branch_import_template.xlsx');
    }

    #[Test]
    public function it_can_import_branches_from_excel_file()
    {
        // Create a simple Excel file for testing
        $templatePath = storage_path('app/temp/test_branch_import.xlsx');
        
        // Ensure the directory exists
        if (!file_exists(storage_path('app/temp'))) {
            mkdir(storage_path('app/temp'), 0755, true);
        }
        
        // Create a writer and add test data
        $writer = SimpleExcelWriter::create($templatePath);
        
        // Add headers
        $writer->addRow([
            'name' => 'name',
            'code' => 'code',
            'address' => 'address',
            'city' => 'city',
            'is_main_branch' => 'is_main_branch'
        ]);
        
        // Add test data
        $writer->addRow([
            'name' => 'Test Import Branch 1',
            'code' => 'IMPORT001',
            'address' => 'Test Address 1',
            'city' => 'Test City 1',
            'is_main_branch' => 'Yes'
        ]);
        
        $writer->addRow([
            'name' => 'Test Import Branch 2',
            'code' => 'IMPORT002',
            'address' => 'Test Address 2',
            'city' => 'Test City 2',
            'is_main_branch' => 'No'
        ]);
        
        $writer->close();
        
        // Create an uploaded file from the template
        $file = new UploadedFile(
            $templatePath,
            'test_branch_import.xlsx',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            null,
            true
        );
        
        // Send the import request
        $response = $this->post(route('organization.branch.import.process'), [
            'file' => $file,
            'company_id' => \App\Models\Company::first()->id,
        ]);
        
        // Assert successful response
        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
        ]);
        
        // Assert the data was imported
        $this->assertDatabaseHas('branches', [
            'name' => 'Test Import Branch 1',
            'code' => 'IMPORT001',
        ]);
        
        $this->assertDatabaseHas('branches', [
            'name' => 'Test Import Branch 2',
            'code' => 'IMPORT002',
        ]);
    }

    #[Test]
    public function it_validates_the_uploaded_file()
    {
        // Test with no file
        $response = $this->postJson(route('organization.branch.import.process'), []);
        
        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['file']);
        
        // Test with invalid file type
        $file = UploadedFile::fake()->create('document.pdf', 100);
        
        $response = $this->postJson(route('organization.branch.import.process'), [
            'file' => $file,
        ]);
        
        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['file']);
    }

    #[Test]
    public function it_handles_invalid_data_in_import_file()
    {
        // First, create a branch with a known code to test duplicate validation
        $existingBranch = \App\Models\Branch::create([
            'name' => 'Existing Branch',
            'code' => 'IMPORT001',
            'company_id' => \App\Models\Company::first()->id,
            'is_active' => true
        ]);
        
        // Create a simple Excel file for testing
        $templatePath = storage_path('app/temp/invalid_branch_import.xlsx');
        
        // Ensure the directory exists
        if (!file_exists(storage_path('app/temp'))) {
            mkdir(storage_path('app/temp'), 0755, true);
        }
        
        // Create a writer and add test data
        $writer = \Spatie\SimpleExcel\SimpleExcelWriter::create($templatePath);
        
        // Add headers
        $writer->addRow([
            'name' => 'name',
            'code' => 'code',
            'address' => 'address',
            'city' => 'city',
            'is_main_branch' => 'is_main_branch'
        ]);
        
        // Add invalid data (missing code)
        $writer->addRow([
            'name' => 'Invalid Branch 1',
            'code' => '', // Missing code
            'address' => 'Invalid Address 1',
            'city' => 'Invalid City 1',
            'is_main_branch' => 'Yes'
        ]);
        
        // Add another invalid row (duplicate code)
        $writer->addRow([
            'name' => 'Invalid Branch 2',
            'code' => 'IMPORT001', // This code already exists
            'address' => 'Invalid Address 2',
            'city' => 'Invalid City 2',
            'is_main_branch' => 'No'
        ]);
        
        $writer->close();
        
        // Create an uploaded file from the template
        $file = new UploadedFile(
            $templatePath,
            'invalid_branch_import.xlsx',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            null,
            true
        );
        
        // Send the import request
        $response = $this->post(route('organization.branch.import.process'), [
            'file' => $file,
            'company_id' => \App\Models\Company::first()->id,
        ]);
        
        // Count branches with the name "Invalid Branch 1" - should be 0
        $this->assertEquals(0, \App\Models\Branch::where('name', 'Invalid Branch 1')->count());
        
        // The only branch with code IMPORT001 should be the existing one
        $this->assertEquals(1, \App\Models\Branch::where('code', 'IMPORT001')->count());
        $this->assertEquals('Existing Branch', \App\Models\Branch::where('code', 'IMPORT001')->first()->name);
    }
}
