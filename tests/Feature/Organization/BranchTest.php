<?php

namespace Tests\Feature\Organization;

use App\Models\Branch;
use App\Models\Company;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Inertia\Testing\AssertableInertia as Assert;
use PHPUnit\Framework\Attributes\Test;
use Spatie\SimpleExcel\SimpleExcelWriter;
use Tests\TestCase;

class BranchTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected $user;

    protected $company;

    protected function setUp(): void
    {
        parent::setUp();

        // Create a user for testing
        $this->user = User::factory()->create();

        // Authenticate the user
        $this->actingAs($this->user);

        // Create a company for testing
        $this->company = Company::create([
            'name' => 'Test Company',
            'code' => 'TEST',
            'email' => 'test@company.com',
            'is_active' => true,
            'owner_id' => $this->user->id,
        ]);

        // Set up storage for file uploads
        Storage::fake('local');
    }

    /**
     * CRUD OPERATION TESTS
     */
    #[Test]
    public function user_can_view_branch_list()
    {
        // Create some test branches
        Branch::factory()->count(3)->create([
            'company_id' => $this->company->id,
        ]);

        $response = $this->get(route('organization.branch.index'));

        $response->assertStatus(200);
        $response->assertInertia(fn (Assert $page) => $page
            ->component('organization/branch/index')
            ->has('branches.data')
        );
    }

    #[Test]
    public function user_can_search_and_filter_branches()
    {
        // Create branches with different attributes
        $branch1 = Branch::create([
            'name' => 'Main Branch',
            'code' => 'MAIN001',
            'city' => 'New York',
            'company_id' => $this->company->id,
            'is_active' => true,
            'is_main_branch' => true,
        ]);

        $branch2 = Branch::create([
            'name' => 'Secondary Branch',
            'code' => 'SEC002',
            'city' => 'Los Angeles',
            'company_id' => $this->company->id,
            'is_active' => true,
            'is_main_branch' => false,
        ]);

        // Test search by name
        $response = $this->get(route('organization.branch.index', ['search' => 'Main']));
        $response->assertStatus(200);
        $response->assertInertia(fn (Assert $page) => $page
            ->component('organization/branch/index')
            ->has('branches.data', 1)
            ->where('branches.data.0.name', 'Main Branch')
        );

        // Test filter by city
        $response = $this->get(route('organization.branch.index', ['city' => 'Los Angeles']));
        $response->assertStatus(200);
        $response->assertInertia(fn (Assert $page) => $page
            ->component('organization/branch/index')
            ->has('branches.data', 1)
            ->where('branches.data.0.name', 'Secondary Branch')
        );

        // Test filter by company
        $response = $this->get(route('organization.branch.index', ['company_id' => $this->company->id]));
        $response->assertStatus(200);
        $response->assertInertia(fn (Assert $page) => $page
            ->component('organization/branch/index')
            ->has('branches.data', 2)
        );
    }

    #[Test]
    public function user_can_view_branch_create_form()
    {
        $response = $this->get(route('organization.branch.create'));

        $response->assertStatus(200);
        $response->assertInertia(fn (Assert $page) => $page
            ->component('organization/branch/create')
            ->has('companies')
        );
    }

    #[Test]
    public function user_can_create_a_branch()
    {
        $branchData = [
            'name' => 'New Test Branch',
            'code' => 'TEST001',
            'address' => '123 Test Street',
            'city' => 'Test City',
            'state' => 'Test State',
            'postal_code' => '12345',
            'country' => 'Test Country',
            'phone' => '1234567890',
            'email' => 'branch@test.com',
            'company_id' => $this->company->id,
            'is_main_branch' => false,
            'is_active' => true,
            'description' => 'This is a test branch',
        ];

        $response = $this->post(route('organization.branch.store'), $branchData);

        $response->assertRedirect(route('organization.branch.index'));
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('branches', [
            'name' => 'New Test Branch',
            'code' => 'TEST001',
            'company_id' => $this->company->id,
        ]);
    }

    #[Test]
    public function user_can_view_branch_edit_form()
    {
        $branch = Branch::create([
            'name' => 'Branch to Edit',
            'code' => 'EDIT001',
            'company_id' => $this->company->id,
            'is_active' => true,
        ]);

        $response = $this->get(route('organization.branch.edit', $branch->id));

        $response->assertStatus(200);
        $response->assertInertia(fn (Assert $page) => $page
            ->component('organization/branch/edit')
            ->has('branch')
            ->where('branch.id', $branch->id)
            ->where('branch.name', 'Branch to Edit')
            ->has('companies')
        );
    }

    #[Test]
    public function user_can_update_a_branch()
    {
        $branch = Branch::create([
            'name' => 'Original Branch Name',
            'code' => 'ORIG001',
            'company_id' => $this->company->id,
            'is_active' => true,
        ]);

        $updatedData = [
            'name' => 'Updated Branch Name',
            'code' => 'UPD001',
            'address' => '456 Updated Street',
            'city' => 'Updated City',
            'state' => 'Updated State',
            'postal_code' => '54321',
            'country' => 'Updated Country',
            'phone' => '0987654321',
            'email' => 'updated@branch.com',
            'company_id' => $this->company->id,
            'is_main_branch' => true,
            'is_active' => false,
            'description' => 'This is an updated test branch',
        ];

        $response = $this->put(route('organization.branch.update', $branch->id), $updatedData);

        $response->assertRedirect(route('organization.branch.index'));
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('branches', [
            'id' => $branch->id,
            'name' => 'Updated Branch Name',
            'code' => 'UPD001',
            'is_active' => false,
            'is_main_branch' => true,
        ]);
    }

    #[Test]
    public function user_can_delete_a_branch()
    {
        $branch = Branch::create([
            'name' => 'Branch to Delete',
            'code' => 'DEL001',
            'company_id' => $this->company->id,
            'is_active' => true,
        ]);

        $response = $this->delete(route('organization.branch.destroy', $branch->id));

        $response->assertRedirect(route('organization.branch.index'));
        $response->assertSessionHas('success');

        $this->assertDatabaseMissing('branches', [
            'id' => $branch->id,
        ]);
    }

    /**
     * LAYOUT TESTS
     */
    #[Test]
    public function branch_list_has_correct_layout_structure()
    {
        // Create test branches
        Branch::create([
            'name' => 'Layout Test Branch',
            'code' => 'LAYOUT001',
            'city' => 'Layout City',
            'company_id' => $this->company->id,
            'is_active' => true,
        ]);

        $response = $this->get(route('organization.branch.index'));

        $response->assertStatus(200);
        $response->assertInertia(fn (Assert $page) => $page
            ->component('organization/branch/index')
            ->has('branches.data')
            ->has('branches.data.0', fn (Assert $branch) => $branch
                ->has('id')
                ->has('name')
                ->has('code')
                ->has('address')
                ->has('city')
                ->has('company')
                ->has('is_main_branch')
                ->has('is_active')
                ->has('created_at')
            )
            ->has('filters')
            ->has('companies')
            ->has('cities')
        );
    }

    #[Test]
    public function branch_create_form_has_correct_layout_structure()
    {
        $response = $this->get(route('organization.branch.create'));

        $response->assertStatus(200);
        $response->assertInertia(fn (Assert $page) => $page
            ->component('organization/branch/create')
            ->has('companies')
        );
    }

    #[Test]
    public function branch_edit_form_has_correct_layout_structure()
    {
        $branch = Branch::create([
            'name' => 'Layout Edit Branch',
            'code' => 'LAYOUTEDIT',
            'company_id' => $this->company->id,
            'is_active' => true,
        ]);

        $response = $this->get(route('organization.branch.edit', $branch->id));

        $response->assertStatus(200);
        $response->assertInertia(fn (Assert $page) => $page
            ->component('organization/branch/edit')
            ->has('branch')
            ->where('branch.id', $branch->id)
            ->where('branch.name', 'Layout Edit Branch')
            ->has('companies')
        );
    }

    /**
     * IMPORT FUNCTIONALITY TESTS
     */
    #[Test]
    public function user_can_download_branch_import_template()
    {
        $response = $this->get(route('organization.branch.import.template'));

        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        $response->assertHeader('Content-Disposition', 'attachment; filename=branch_import_template.xlsx');
    }

    #[Test]
    public function user_can_import_branches_from_excel_file()
    {
        // Create a test file path in the storage/app/public/templates directory
        $templatePath = storage_path('app/public/templates/test_branch_import.xlsx');

        // Ensure the directory exists
        if (! file_exists(dirname($templatePath))) {
            mkdir(dirname($templatePath), 0755, true);
        }

        // Create a simple Excel file using Spatie Simple Excel
        $writer = SimpleExcelWriter::create($templatePath);

        // Add header row
        $writer->addRow([
            'name' => 'name',
            'code' => 'code',
            'address' => 'address',
            'city' => 'city',
            'phone' => 'phone',
            'email' => 'email',
            'is_active' => 'is_active',
        ]);

        // Add test data rows
        $writer->addRow([
            'name' => 'Test Import Branch 1',
            'code' => 'IMPORT001',
            'address' => '111 Import Street',
            'city' => 'Import City 1',
            'phone' => '1111111111',
            'email' => 'import1@branch.com',
            'is_active' => 'Yes',
        ]);

        $writer->addRow([
            'name' => 'Test Import Branch 2',
            'code' => 'IMPORT002',
            'address' => '222 Import Street',
            'city' => 'Import City 2',
            'phone' => '2222222222',
            'email' => 'import2@branch.com',
            'is_active' => 'No',
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
        ]);

        // Assert the response is successful
        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
        ]);

        // Assert the data was imported
        $this->assertDatabaseHas('branches', [
            'name' => 'Test Import Branch 1',
            'code' => 'IMPORT001',
            'is_active' => 1,
        ]);

        $this->assertDatabaseHas('branches', [
            'name' => 'Test Import Branch 2',
            'code' => 'IMPORT002',
            'is_active' => 0,
        ]);
    }

    #[Test]
    public function import_validates_required_fields()
    {
        // Create a test file path in the storage/app/public/templates directory
        $templatePath = storage_path('app/public/templates/invalid_branch_import.xlsx');

        // Ensure the directory exists
        if (! file_exists(dirname($templatePath))) {
            mkdir(dirname($templatePath), 0755, true);
        }

        // Create a simple Excel file using Spatie Simple Excel
        $writer = SimpleExcelWriter::create($templatePath);

        // Add header row
        $writer->addRow([
            'name' => 'name',
            'code' => 'code',
            'address' => 'address',
            'city' => 'city',
            'phone' => 'phone',
            'email' => 'email',
            'is_active' => 'is_active',
        ]);

        // Add invalid data (missing required code)
        $writer->addRow([
            'name' => 'Invalid Branch',
            'code' => '', // Missing required code
            'address' => '999 Invalid Street',
            'city' => 'Invalid City',
            'phone' => '9999999999',
            'email' => 'invalid@branch.com',
            'is_active' => 'Yes',
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
        ]);

        // Assert the response is successful but contains error information
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'success',
            'message',
            'results' => [
                'total',
                'success',
                'failed',
                'errors',
            ],
        ]);

        // Assert the invalid data was not imported
        $this->assertDatabaseMissing('branches', [
            'name' => 'Invalid Branch',
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
        $response = $this->postJson(route('organization.branch.import.process'), [
            'file' => $file,
        ]);

        // Assert validation error
        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['file']);
    }

    #[Test]
    public function import_handles_duplicate_codes()
    {
        // Create an existing branch
        $existingBranch = Branch::create([
            'name' => 'Existing Branch',
            'code' => 'DUPLICATE',
            'company_id' => $this->company->id,
            'is_active' => true,
        ]);

        // Create a test file path in the storage/app/public/templates directory
        $templatePath = storage_path('app/public/templates/duplicate_branch_import.xlsx');

        // Ensure the directory exists
        if (! file_exists(dirname($templatePath))) {
            mkdir(dirname($templatePath), 0755, true);
        }

        // Create a simple Excel file using Spatie Simple Excel
        $writer = SimpleExcelWriter::create($templatePath);

        // Add header row
        $writer->addRow([
            'name' => 'name',
            'code' => 'code',
            'is_active' => 'is_active',
        ]);

        // Add duplicate code data
        $writer->addRow([
            'name' => 'Duplicate Code Branch',
            'code' => 'DUPLICATE', // Already exists
            'is_active' => 'Yes',
        ]);

        $writer->close();

        // Create an uploaded file from the template
        $file = new UploadedFile(
            $templatePath,
            'duplicate_branch_import.xlsx',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            null,
            true
        );

        // Send the import request
        $response = $this->post(route('organization.branch.import.process'), [
            'file' => $file,
        ]);

        // Assert the response is successful but contains error information
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'success',
            'message',
            'results' => [
                'total',
                'success',
                'failed',
                'errors',
            ],
        ]);

        // Assert the duplicate data was not imported
        $this->assertEquals(1, Branch::where('code', 'DUPLICATE')->count());
    }
}
