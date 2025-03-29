<?php

namespace Tests\Feature\Organization;

use App\Models\Brand;
use App\Models\User;
use App\Models\Company;
use App\Models\Branch;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class BrandImportTest extends TestCase
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
        ]);
        
        // Set up storage for file uploads
        Storage::fake('local');
    }

    #[Test]
    public function it_can_download_brand_import_template()
    {
        $response = $this->get(route('organization.brand.import.template'));
        
        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        $response->assertHeader('Content-Disposition', 'attachment; filename=brand_import_template.xlsx');
    }

    #[Test]
    public function it_can_import_brands_from_excel_file()
    {
        // Create a simple Excel file for testing
        $filePath = storage_path('app/temp/test_brand_import.xlsx');
        
        // Ensure the directory exists
        if (!file_exists(storage_path('app/temp'))) {
            mkdir(storage_path('app/temp'), 0755, true);
        }
        
        // Create a writer and add test data
        $writer = \Spatie\SimpleExcel\SimpleExcelWriter::create($filePath);
        
        // Add headers
        $writer->addRow([
            'name' => 'name',
            'code' => 'code',
            'description' => 'description',
            'is_active' => 'is_active'
        ]);
        
        // Add test data
        $writer->addRow([
            'name' => 'Test Brand 1',
            'code' => 'BRD001',
            'description' => 'Test Brand 1 Description',
            'is_active' => 'Yes'
        ]);
        
        $writer->addRow([
            'name' => 'Test Brand 2',
            'code' => 'BRD002',
            'description' => 'Test Brand 2 Description',
            'is_active' => 'No'
        ]);
        
        $writer->addRow([
            'name' => 'Test Brand 3',
            'code' => 'BRD003',
            'description' => 'Test Brand 3 Description',
            'is_active' => 'Yes'
        ]);
        
        $writer->close();
        
        // Create an uploaded file from the test file
        $file = new UploadedFile(
            $filePath,
            'test_brand_import.xlsx',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            null,
            true
        );
        
        // Send the import request
        $response = $this->post(route('organization.brand.import.process'), [
            'file' => $file,
            'company_id' => $this->company->id,
            'branch_id' => $this->branch->id,
        ]);
        
        // Assert redirect back with success message
        $response->assertRedirect();
        $response->assertSessionHas('success');
        
        // Assert the data was imported
        $this->assertDatabaseHas('brands', [
            'name' => 'Test Brand 1',
            'code' => 'BRD001',
            'company_id' => $this->company->id,
            'branch_id' => $this->branch->id,
            'is_active' => 1,
        ]);
        
        $this->assertDatabaseHas('brands', [
            'name' => 'Test Brand 2',
            'code' => 'BRD002',
            'company_id' => $this->company->id,
            'branch_id' => $this->branch->id,
            'is_active' => 0,
        ]);
        
        $this->assertDatabaseHas('brands', [
            'name' => 'Test Brand 3',
            'code' => 'BRD003',
            'company_id' => $this->company->id,
            'branch_id' => $this->branch->id,
            'is_active' => 1,
        ]);
    }

    #[Test]
    public function it_validates_the_uploaded_file()
    {
        // Test with no file
        $response = $this->post(route('organization.brand.import.process'), [
            'company_id' => $this->company->id,
            'branch_id' => $this->branch->id,
        ]);
        
        $response->assertSessionHasErrors(['file']);
        
        // Test with invalid file type
        $file = UploadedFile::fake()->create('document.pdf', 100);
        
        $response = $this->post(route('organization.brand.import.process'), [
            'file' => $file,
            'company_id' => $this->company->id,
            'branch_id' => $this->branch->id,
        ]);
        
        $response->assertSessionHasErrors(['file']);
    }

    #[Test]
    public function it_validates_required_company_and_branch()
    {
        $file = UploadedFile::fake()->create('brands.xlsx', 100, 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        
        // Test without company_id
        $response = $this->post(route('organization.brand.import.process'), [
            'file' => $file,
            'branch_id' => $this->branch->id,
        ]);
        
        $response->assertSessionHasErrors(['company_id']);
        
        // Test without branch_id
        $response = $this->post(route('organization.brand.import.process'), [
            'file' => $file,
            'company_id' => $this->company->id,
        ]);
        
        $response->assertSessionHasErrors(['branch_id']);
    }

    #[Test]
    public function it_handles_invalid_data_in_import_file()
    {
        // First, create a brand with a known code to test duplicate validation
        Brand::create([
            'name' => 'Existing Brand',
            'code' => 'BRD001',
            'company_id' => $this->company->id,
            'branch_id' => $this->branch->id,
            'is_active' => true,
        ]);
        
        // Create a file with invalid data
        $filePath = storage_path('app/temp/invalid_brand_import.xlsx');
        
        // Ensure the directory exists
        if (!file_exists(storage_path('app/temp'))) {
            mkdir(storage_path('app/temp'), 0755, true);
        }
        
        // Create a writer and add test data
        $writer = \Spatie\SimpleExcel\SimpleExcelWriter::create($filePath);
        
        // Add headers
        $writer->addRow([
            'name' => 'name',
            'code' => 'code',
            'description' => 'description',
            'is_active' => 'is_active'
        ]);
        
        // Add invalid data (missing code)
        $writer->addRow([
            'name' => 'Invalid Brand 1',
            'code' => '', // Missing code
            'description' => 'Invalid Brand 1 Description',
            'is_active' => 'Yes'
        ]);
        
        // Add another invalid row (duplicate code)
        $writer->addRow([
            'name' => 'Invalid Brand 2',
            'code' => 'BRD001', // This code already exists
            'description' => 'Invalid Brand 2 Description',
            'is_active' => 'Yes'
        ]);
        
        $writer->close();
        
        // Create an uploaded file from the test file
        $file = new UploadedFile(
            $filePath,
            'invalid_brand_import.xlsx',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            null,
            true
        );
        
        // Send the import request
        $response = $this->post(route('organization.brand.import.process'), [
            'file' => $file,
            'company_id' => $this->company->id,
            'branch_id' => $this->branch->id,
        ]);
        
        // Assert redirect back with success message (even with errors, the import process completes)
        $response->assertRedirect();
        $response->assertSessionHas('success');
        
        // Ensure no brands were created with invalid data
        $this->assertEquals(1, Brand::count()); // Only the existing brand should be in the database
        
        // Verify the existing brand wasn't modified
        $this->assertDatabaseHas('brands', [
            'name' => 'Existing Brand',
            'code' => 'BRD001',
        ]);
        
        // Verify the invalid brands weren't created
        $this->assertDatabaseMissing('brands', [
            'name' => 'Invalid Brand 1',
        ]);
        
        $this->assertDatabaseMissing('brands', [
            'name' => 'Invalid Brand 2',
            'code' => 'BRD001',
            'description' => 'Invalid Brand 2 Description',
        ]);
    }
}
