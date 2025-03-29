<?php

namespace Tests\Feature\Organization;

use App\Models\Branch;
use App\Models\Company;
use App\Models\Department;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\Fixtures\TestDepartmentExcelGenerator;
use Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class DepartmentImportTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected User $user;
    protected Company $company;
    protected Branch $branch;

    protected function setUp(): void
    {
        parent::setUp();
        
        // Create a user and authenticate
        $this->user = User::factory()->create();
        $this->actingAs($this->user);
        
        // Create a company for testing
        $this->company = Company::create([
            'name' => 'Test Company',
            'code' => 'TEST',
            'email' => 'test@company.com',
            'is_active' => true,
            'owner_id' => $this->user->id // Set the authenticated user as the company owner
        ]);
        
        // Create a branch for testing
        $this->branch = Branch::create([
            'name' => 'Test Branch',
            'code' => 'BR001',
            'company_id' => $this->company->id,
            'is_active' => true,
            'is_main_branch' => true
        ]);
        
        // Set up storage for file uploads
        Storage::fake('local');
        
        // Generate test files
        TestDepartmentExcelGenerator::createValidFile();
        TestDepartmentExcelGenerator::createInvalidFile();
    }

    #[Test]
    public function it_can_download_department_import_template()
    {
        $response = $this->get('/organization/department/import/template');
        
        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        $response->assertHeader('Content-Disposition', 'attachment; filename=department_import_template.xlsx');
    }

    #[Test]
    public function it_can_import_departments_from_excel_file()
    {
        // Make sure the departments table is empty before starting
        $this->assertEquals(0, Department::count(), 'Departments table should be empty before import test');
        
        // Use the existing template file from storage
        $templatePath = storage_path('app/public/templates/test_department_import.xlsx');
        
        // Create an uploaded file from the template
        $file = new UploadedFile(
            $templatePath,
            'test_department_import.xlsx',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            null,
            true
        );
        
        // Send the import request
        $response = $this->postJson('/organization/department/import/process', [
            'file' => $file,
        ]);
        
        // For debugging purposes
        if ($response->getStatusCode() != 200) {
            $this->fail('Response status code: ' . $response->getStatusCode() . ', Content: ' . $response->getContent());
        }
        
        // Assert the response is successful
        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'message' => 'Import completed successfully.',
        ]);
        
        // Get the response data
        $responseData = $response->json();
        
        // Assert that departments were imported successfully
        $this->assertGreaterThan(0, $responseData['results']['success'] ?? 0, 'Expected at least one successful import');
        $this->assertGreaterThan(0, Department::count(), 'Expected departments to be imported');
        
        // Check for the first department that should have been created
        $this->assertDatabaseHas('departments', [
            'name' => 'Test Department 1',
            'description' => 'Test Department 1 Description',
            'status' => 'active',
        ]);
    }

    #[Test]
    public function it_validates_the_uploaded_file()
    {
        // Test with no file
        $response = $this->postJson('/organization/department/import/process', []);
        
        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['file']);
        
        // Test with invalid file type
        $file = UploadedFile::fake()->create('document.pdf', 100);
        
        $response = $this->postJson('/organization/department/import/process', [
            'file' => $file,
        ]);
        
        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['file']);
    }

    #[Test]
    public function it_handles_invalid_data_in_import_file()
    {
        // Make sure the departments table is empty before starting
        $this->assertEquals(0, Department::count(), 'Departments table should be empty before import test');
        
        // Use the existing invalid template file from storage
        $templatePath = storage_path('app/public/templates/invalid_department_import.xlsx');
        
        // Create an uploaded file from the template
        $file = new UploadedFile(
            $templatePath,
            'invalid_department_import.xlsx',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            null,
            true
        );
        
        // Send the import request
        $response = $this->postJson('/organization/department/import/process', [
            'file' => $file,
        ]);
        
        // Assert the response is successful
        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'message' => 'Import completed successfully.',
        ]);
        
        // Ensure no departments were created with invalid data
        $this->assertEquals(0, Department::count(), 'No departments should be created from invalid data');
        
        $this->assertDatabaseMissing('departments', [
            'name' => 'Invalid Department 1',
        ]);
        
        $this->assertDatabaseMissing('departments', [
            'name' => 'Invalid Department 2',
        ]);
        
        // Check that the results include failed imports
        $responseData = $response->json();
        $this->assertGreaterThan(0, $responseData['results']['failed']);
        $this->assertEquals(0, $responseData['results']['success']);
    }
    
    #[Test]
    public function it_handles_inertia_requests_for_import()
    {
        // Make sure the departments table is empty before starting
        $this->assertEquals(0, Department::count(), 'Departments table should be empty before import test');
        
        // Use the existing template file from storage
        $templatePath = storage_path('app/public/templates/test_department_import.xlsx');
        
        // Create an uploaded file from the template
        $file = new UploadedFile(
            $templatePath,
            'test_department_import.xlsx',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            null,
            true
        );
        
        // Send the import request as a regular form submission (not JSON)
        $response = $this->post('/organization/department/import/process', [
            'file' => $file,
        ]);
        
        // Assert the response redirects to the department list
        $response->assertRedirect('/organization/department');
        $response->assertSessionHas('success', 'Import completed successfully.');
        
        // Verify that departments were imported
        $this->assertGreaterThan(0, Department::count(), 'Expected departments to be imported');
        
        // Check for the first department that should have been created
        $this->assertDatabaseHas('departments', [
            'name' => 'Test Department 1',
            'description' => 'Test Department 1 Description',
            'status' => 'active',
        ]);
    }
}
