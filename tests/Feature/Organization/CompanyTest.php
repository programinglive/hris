<?php

namespace Tests\Feature\Organization;

use App\Models\Company;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;
use Inertia\Testing\AssertableInertia as Assert;

class CompanyTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();
        
        // Create a user for testing
        $this->user = User::factory()->create();
        
        // Authenticate the user
        $this->actingAs($this->user);
        
        // Set up storage for file uploads
        Storage::fake('local');
    }

    #[Test]
    public function user_can_view_company_list()
    {
        // Create some test companies
        $companies = Company::factory()->count(3)->create([
            'owner_id' => $this->user->id
        ]);
        
        $response = $this->get(route('organization.company.index'));
        
        $response->assertStatus(200);
        $response->assertInertia(fn (Assert $page) => $page
            ->component('organization/company/index')
            ->has('companies.data', 3)
        );
    }

    #[Test]
    public function user_can_view_company_create_form()
    {
        $response = $this->get(route('organization.company.create'));
        
        $response->assertStatus(200);
        $response->assertInertia(fn (Assert $page) => $page
            ->component('organization/company/create')
        );
    }

    #[Test]
    public function user_can_create_a_company()
    {
        $companyData = [
            'name' => 'Test Company',
            'legal_name' => 'Test Legal Name',
            'tax_id' => 'TX12345',
            'registration_number' => 'REG98765',
            'email' => 'test@company.com',
            'phone' => '1234567890',
            'address' => '123 Test Street',
            'city' => 'Test City',
            'state' => 'Test State',
            'postal_code' => '12345',
            'country' => 'Test Country',
            'website' => 'https://test-company.com',
            'description' => 'This is a test company',
            'is_active' => true,
        ];
        
        $response = $this->post(route('organization.company.store'), $companyData);
        
        $response->assertRedirect(route('organization.company.index'));
        $response->assertSessionHas('success', 'Company created successfully.');
        
        $this->assertDatabaseHas('companies', [
            'name' => 'Test Company',
            'email' => 'test@company.com',
            'owner_id' => $this->user->id
        ]);
    }

    #[Test]
    public function user_can_view_company_details()
    {
        $company = Company::factory()->create([
            'owner_id' => $this->user->id
        ]);
        
        $response = $this->get(route('organization.company.show', $company->id));
        
        $response->assertStatus(200);
        $response->assertInertia(fn (Assert $page) => $page
            ->component('organization/company/show')
            ->has('company')
            ->where('company.id', $company->id)
            ->where('company.name', $company->name)
        );
    }

    #[Test]
    public function user_can_view_company_edit_form()
    {
        $company = Company::factory()->create([
            'owner_id' => $this->user->id
        ]);
        
        $response = $this->get(route('organization.company.edit', $company->id));
        
        $response->assertStatus(200);
        $response->assertInertia(fn (Assert $page) => $page
            ->component('organization/company/edit')
            ->has('company')
            ->where('company.id', $company->id)
        );
    }

    #[Test]
    public function user_can_update_a_company()
    {
        $company = Company::factory()->create([
            'owner_id' => $this->user->id,
            'name' => 'Original Company Name'
        ]);
        
        $updatedData = [
            'name' => 'Updated Company Name',
            'legal_name' => 'Updated Legal Name',
            'tax_id' => 'TX54321',
            'registration_number' => 'REG56789',
            'email' => 'updated@company.com',
            'phone' => '0987654321',
            'address' => '456 Updated Street',
            'city' => 'Updated City',
            'state' => 'Updated State',
            'postal_code' => '54321',
            'country' => 'Updated Country',
            'website' => 'https://updated-company.com',
            'description' => 'This is an updated test company',
            'is_active' => false,
        ];
        
        $response = $this->put(route('organization.company.update', $company->id), $updatedData);
        
        $response->assertRedirect(route('organization.company.index'));
        $response->assertSessionHas('success', 'Company updated successfully.');
        
        $this->assertDatabaseHas('companies', [
            'id' => $company->id,
            'name' => 'Updated Company Name',
            'email' => 'updated@company.com',
            'is_active' => false
        ]);
    }

    #[Test]
    public function user_can_delete_a_company()
    {
        $company = Company::factory()->create([
            'owner_id' => $this->user->id
        ]);
        
        $response = $this->delete(route('organization.company.destroy', $company->id));
        
        $response->assertRedirect(route('organization.company.index'));
        $response->assertSessionHas('success', 'Company deleted successfully.');
        
        $this->assertDatabaseMissing('companies', [
            'id' => $company->id
        ]);
    }

    #[Test]
    public function company_list_has_correct_layout_structure()
    {
        // Create test companies
        Company::factory()->count(3)->create([
            'owner_id' => $this->user->id
        ]);
        
        $response = $this->get(route('organization.company.index'));
        
        $response->assertStatus(200);
        $response->assertInertia(fn (Assert $page) => $page
            ->component('organization/company/index')
            ->has('companies.data')
            // Check that the first company has all the expected fields
            ->has('companies.data.0', fn (Assert $company) => $company
                ->has('id')
                ->has('name')
                ->has('email')
                ->has('phone')
                ->has('city')
                ->has('country')
                ->has('is_active')
            )
        );
    }

    #[Test]
    public function company_create_form_has_correct_layout_structure()
    {
        $response = $this->get(route('organization.company.create'));
        
        $response->assertStatus(200);
        $response->assertInertia(fn (Assert $page) => $page
            ->component('organization/company/create')
        );
    }

    #[Test]
    public function company_edit_form_has_correct_layout_structure()
    {
        $company = Company::factory()->create([
            'owner_id' => $this->user->id
        ]);
        
        $response = $this->get(route('organization.company.edit', $company->id));
        
        $response->assertStatus(200);
        $response->assertInertia(fn (Assert $page) => $page
            ->component('organization/company/edit')
            ->has('company')
            ->where('company.id', $company->id)
            ->where('company.name', $company->name)
            ->where('company.email', $company->email)
        );
    }

    #[Test]
    public function company_show_page_has_correct_layout_structure()
    {
        $company = Company::factory()->create([
            'owner_id' => $this->user->id
        ]);
        
        $response = $this->get(route('organization.company.show', $company->id));
        
        $response->assertStatus(200);
        $response->assertInertia(fn (Assert $page) => $page
            ->component('organization/company/show')
            ->has('company')
            ->where('company.id', $company->id)
            ->where('company.name', $company->name)
            ->where('company.email', $company->email)
        );
    }

    #[Test]
    public function user_can_download_company_import_template()
    {
        $response = $this->get(route('organization.company.import.template'));
        
        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        $response->assertHeader('Content-Disposition', 'attachment; filename=company_import_template.xlsx');
    }

    #[Test]
    public function user_can_import_companies_from_excel_file()
    {
        // Create a test file path in the storage/app/public/templates directory
        $templatePath = storage_path('app/public/templates/test_company_import.xlsx');
        
        // Ensure the directory exists
        if (!file_exists(dirname($templatePath))) {
            mkdir(dirname($templatePath), 0755, true);
        }
        
        // Create a simple Excel file using Spatie Simple Excel
        $writer = \Spatie\SimpleExcel\SimpleExcelWriter::create($templatePath);
        
        // Add header row
        $writer->addRow([
            'name' => 'Name*',
            'legal_name' => 'Legal Name',
            'tax_id' => 'Tax ID',
            'registration_number' => 'Registration Number',
            'email' => 'Email*',
            'phone' => 'Phone',
            'address' => 'Address',
            'city' => 'City',
            'state' => 'State',
            'postal_code' => 'Postal Code',
            'country' => 'Country',
            'website' => 'Website',
            'description' => 'Description',
            'is_active' => 'Is Active (Yes/No)'
        ]);
        
        // Add test data rows
        $writer->addRow([
            'name' => 'Test Import Company 1',
            'legal_name' => 'Test Legal Name 1',
            'tax_id' => 'TX1111',
            'registration_number' => 'REG1111',
            'email' => 'import1@company.com',
            'phone' => '1111111111',
            'address' => '111 Import Street',
            'city' => 'Import City 1',
            'state' => 'Import State 1',
            'postal_code' => '11111',
            'country' => 'Import Country 1',
            'website' => 'https://import1.com',
            'description' => 'This is import test company 1',
            'is_active' => 'Yes'
        ]);
        
        $writer->addRow([
            'name' => 'Test Import Company 2',
            'legal_name' => 'Test Legal Name 2',
            'tax_id' => 'TX2222',
            'registration_number' => 'REG2222',
            'email' => 'import2@company.com',
            'phone' => '2222222222',
            'address' => '222 Import Street',
            'city' => 'Import City 2',
            'state' => 'Import State 2',
            'postal_code' => '22222',
            'country' => 'Import Country 2',
            'website' => 'https://import2.com',
            'description' => 'This is import test company 2',
            'is_active' => 'No'
        ]);
        
        $writer->close();
        
        // Create an uploaded file from the template
        $file = new UploadedFile(
            $templatePath,
            'test_company_import.xlsx',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            null,
            true
        );
        
        // Send the import request
        $response = $this->post(route('organization.company.import.process'), [
            'file' => $file,
        ]);
        
        // Assert the data was imported
        $this->assertDatabaseHas('companies', [
            'name' => 'Test Import Company 1',
            'email' => 'import1@company.com',
            'is_active' => 1
        ]);
        
        $this->assertDatabaseHas('companies', [
            'name' => 'Test Import Company 2',
            'email' => 'import2@company.com',
            'is_active' => 0
        ]);
        
        // Check for success message
        $response->assertSessionHas('success');
    }

    #[Test]
    public function import_validates_required_fields()
    {
        // Create a test file path in the storage/app/public/templates directory
        $templatePath = storage_path('app/public/templates/invalid_company_import.xlsx');
        
        // Ensure the directory exists
        if (!file_exists(dirname($templatePath))) {
            mkdir(dirname($templatePath), 0755, true);
        }
        
        // Create a simple Excel file using Spatie Simple Excel
        $writer = \Spatie\SimpleExcel\SimpleExcelWriter::create($templatePath);
        
        // Add header row
        $writer->addRow([
            'name' => 'Name*',
            'legal_name' => 'Legal Name',
            'tax_id' => 'Tax ID',
            'registration_number' => 'Registration Number',
            'email' => 'Email*',
            'phone' => 'Phone',
            'address' => 'Address',
            'city' => 'City',
            'state' => 'State',
            'postal_code' => 'Postal Code',
            'country' => 'Country',
            'website' => 'Website',
            'description' => 'Description',
            'is_active' => 'Is Active (Yes/No)'
        ]);
        
        // Add invalid data (missing required email)
        $writer->addRow([
            'name' => 'Invalid Company',
            'legal_name' => 'Invalid Legal Name',
            'tax_id' => 'TX9999',
            'registration_number' => 'REG9999',
            'email' => '', // Missing required email
            'phone' => '9999999999',
            'address' => '999 Invalid Street',
            'city' => 'Invalid City',
            'state' => 'Invalid State',
            'postal_code' => '99999',
            'country' => 'Invalid Country',
            'website' => 'https://invalid.com',
            'description' => 'This is an invalid test company',
            'is_active' => 'Yes'
        ]);
        
        $writer->close();
        
        // Create an uploaded file from the template
        $file = new UploadedFile(
            $templatePath,
            'invalid_company_import.xlsx',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            null,
            true
        );
        
        // Send the import request
        $response = $this->post(route('organization.company.import.process'), [
            'file' => $file,
        ]);
        
        // Assert the invalid data was not imported
        $this->assertDatabaseMissing('companies', [
            'name' => 'Invalid Company',
        ]);
    }

    #[Test]
    public function import_validates_file_type()
    {
        // Create an invalid file type
        $file = UploadedFile::fake()->create(
            'invalid.pdf',
            100,
            'application/pdf'
        );
        
        // Send the import request
        $response = $this->post(route('organization.company.import.process'), [
            'file' => $file,
        ]);
        
        // Assert validation error
        $response->assertSessionHasErrors('file');
    }

    #[Test]
    public function import_handles_duplicate_emails()
    {
        // Create an existing company
        $existingCompany = Company::factory()->create([
            'name' => 'Existing Company',
            'email' => 'duplicate@company.com',
            'owner_id' => $this->user->id
        ]);
        
        // Create a test file path in the storage/app/public/templates directory
        $templatePath = storage_path('app/public/templates/duplicate_company_import.xlsx');
        
        // Ensure the directory exists
        if (!file_exists(dirname($templatePath))) {
            mkdir(dirname($templatePath), 0755, true);
        }
        
        // Create a simple Excel file using Spatie Simple Excel
        $writer = \Spatie\SimpleExcel\SimpleExcelWriter::create($templatePath);
        
        // Add header row
        $writer->addRow([
            'name' => 'Name*',
            'email' => 'Email*',
            'is_active' => 'Is Active (Yes/No)'
        ]);
        
        // Add duplicate email data
        $writer->addRow([
            'name' => 'Duplicate Email Company',
            'email' => 'duplicate@company.com', // Already exists
            'is_active' => 'Yes'
        ]);
        
        $writer->close();
        
        // Create an uploaded file from the template
        $file = new UploadedFile(
            $templatePath,
            'duplicate_company_import.xlsx',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            null,
            true
        );
        
        // Send the import request
        $response = $this->post(route('organization.company.import.process'), [
            'file' => $file,
        ]);
        
        // Assert the duplicate data was not imported
        $this->assertEquals(1, Company::where('email', 'duplicate@company.com')->count());
    }
}
