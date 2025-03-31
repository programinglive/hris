<?php

namespace Tests\Feature\Organization;

use App\Models\Branch;
use App\Models\Brand;
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

class BrandTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected $user;

    protected $company;

    protected $branch;

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

        // Create a branch for testing
        $this->branch = Branch::create([
            'name' => 'Test Branch',
            'code' => 'BRANCH001',
            'company_id' => $this->company->id,
            'is_active' => true,
        ]);

        // Set up storage for file uploads
        Storage::fake('local');
    }

    /**
     * CRUD OPERATION TESTS
     */
    #[Test]
    public function user_can_view_brand_list()
    {
        // Create some test brands
        Brand::create([
            'name' => 'Test Brand 1',
            'code' => 'BRAND001',
            'company_id' => $this->company->id,
            'branch_id' => $this->branch->id,
            'is_active' => true,
        ]);

        Brand::create([
            'name' => 'Test Brand 2',
            'code' => 'BRAND002',
            'company_id' => $this->company->id,
            'branch_id' => $this->branch->id,
            'is_active' => true,
        ]);

        $response = $this->get(route('organization.brand.index'));

        $response->assertStatus(200);
        $response->assertInertia(fn (Assert $page) => $page
            ->component('organization/brand/index')
            ->has('brands.data', 2)
        );
    }

    #[Test]
    public function user_can_search_and_filter_brands()
    {
        // Create brands with different attributes
        $brand1 = Brand::create([
            'name' => 'Main Brand',
            'code' => 'MAIN001',
            'company_id' => $this->company->id,
            'branch_id' => $this->branch->id,
            'is_active' => true,
        ]);

        // Create another company and branch for filtering
        $company2 = Company::create([
            'name' => 'Second Company',
            'code' => 'COMP2',
            'email' => 'second@company.com',
            'is_active' => true,
            'owner_id' => $this->user->id,
        ]);

        $branch2 = Branch::create([
            'name' => 'Second Branch',
            'code' => 'BRANCH002',
            'company_id' => $company2->id,
            'is_active' => true,
        ]);

        $brand2 = Brand::create([
            'name' => 'Secondary Brand',
            'code' => 'SEC002',
            'company_id' => $company2->id,
            'branch_id' => $branch2->id,
            'is_active' => true,
        ]);

        // Test search by name
        $response = $this->get(route('organization.brand.index', ['search' => 'Main']));
        $response->assertStatus(200);
        $response->assertInertia(fn (Assert $page) => $page
            ->component('organization/brand/index')
            ->has('brands.data', 1)
            ->where('brands.data.0.name', 'Main Brand')
        );

        // Test filter by company
        $response = $this->get(route('organization.brand.index', ['company_id' => $company2->id]));
        $response->assertStatus(200);
        $response->assertInertia(fn (Assert $page) => $page
            ->component('organization/brand/index')
            ->has('brands.data', 1)
            ->where('brands.data.0.name', 'Secondary Brand')
        );

        // Test filter by branch
        $response = $this->get(route('organization.brand.index', ['branch_id' => $branch2->id]));
        $response->assertStatus(200);
        $response->assertInertia(fn (Assert $page) => $page
            ->component('organization/brand/index')
            ->has('brands.data', 1)
            ->where('brands.data.0.name', 'Secondary Brand')
        );
    }

    #[Test]
    public function user_can_view_brand_create_form()
    {
        $response = $this->get(route('organization.brand.create'));

        $response->assertStatus(200);
        $response->assertInertia(fn (Assert $page) => $page
            ->component('organization/brand/create')
            ->has('companies')
            ->has('branches')
        );
    }

    #[Test]
    public function user_can_create_a_brand()
    {
        $brandData = [
            'name' => 'New Test Brand',
            'code' => 'NEWBRAND001',
            'description' => 'This is a test brand',
            'company_id' => $this->company->id,
            'branch_id' => $this->branch->id,
            'is_active' => true,
        ];

        $response = $this->post(route('organization.brand.store'), $brandData);

        $response->assertRedirect(route('organization.brand.index'));
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('brands', [
            'name' => 'New Test Brand',
            'code' => 'NEWBRAND001',
            'company_id' => $this->company->id,
            'branch_id' => $this->branch->id,
        ]);
    }

    #[Test]
    public function user_can_view_brand_edit_form()
    {
        $brand = Brand::create([
            'name' => 'Brand to Edit',
            'code' => 'EDIT001',
            'company_id' => $this->company->id,
            'branch_id' => $this->branch->id,
            'is_active' => true,
        ]);

        $response = $this->get(route('organization.brand.edit', $brand->id));

        $response->assertStatus(200);
        $response->assertInertia(fn (Assert $page) => $page
            ->component('organization/brand/edit')
            ->has('brand')
            ->where('brand.id', $brand->id)
            ->where('brand.name', 'Brand to Edit')
            ->has('companies')
            ->has('branches')
        );
    }

    #[Test]
    public function user_can_update_a_brand()
    {
        $brand = Brand::create([
            'name' => 'Original Brand Name',
            'code' => 'ORIG001',
            'company_id' => $this->company->id,
            'branch_id' => $this->branch->id,
            'is_active' => true,
        ]);

        $updatedData = [
            'name' => 'Updated Brand Name',
            'code' => 'UPD001',
            'description' => 'This is an updated test brand',
            'company_id' => $this->company->id,
            'branch_id' => $this->branch->id,
            'is_active' => false,
        ];

        $response = $this->put(route('organization.brand.update', $brand->id), $updatedData);

        $response->assertRedirect(route('organization.brand.index'));
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('brands', [
            'id' => $brand->id,
            'name' => 'Updated Brand Name',
            'code' => 'UPD001',
            'is_active' => false,
        ]);
    }

    #[Test]
    public function user_can_delete_a_brand()
    {
        $brand = Brand::create([
            'name' => 'Brand to Delete',
            'code' => 'DEL001',
            'company_id' => $this->company->id,
            'branch_id' => $this->branch->id,
            'is_active' => true,
        ]);

        $response = $this->delete(route('organization.brand.destroy', $brand->id));

        $response->assertRedirect(route('organization.brand.index'));
        $response->assertSessionHas('success');

        $this->assertDatabaseMissing('brands', [
            'id' => $brand->id,
        ]);
    }

    /**
     * LAYOUT TESTS
     */
    #[Test]
    public function brand_list_has_correct_layout_structure()
    {
        // Create test brand
        $brand = Brand::create([
            'name' => 'Layout Test Brand',
            'code' => 'LAYOUT001',
            'company_id' => $this->company->id,
            'branch_id' => $this->branch->id,
            'is_active' => true,
        ]);

        $response = $this->get(route('organization.brand.index'));

        $response->assertStatus(200);
        $response->assertInertia(fn (Assert $page) => $page
            ->component('organization/brand/index')
            ->has('brands.data')
            ->has('brands.data.0', fn (Assert $brand) => $brand
                ->has('id')
                ->has('name')
                ->has('code')
                ->has('logo')
                ->has('company')
                ->has('branch')
                ->has('is_active')
                ->has('created_at')
            )
            ->has('companies')
            ->has('branches')
            ->has('filters')
        );
    }

    #[Test]
    public function brand_create_form_has_correct_layout_structure()
    {
        $response = $this->get(route('organization.brand.create'));

        $response->assertStatus(200);
        $response->assertInertia(fn (Assert $page) => $page
            ->component('organization/brand/create')
            ->has('companies')
            ->has('branches')
        );
    }

    #[Test]
    public function brand_edit_form_has_correct_layout_structure()
    {
        $brand = Brand::create([
            'name' => 'Layout Edit Brand',
            'code' => 'LAYOUTEDIT',
            'company_id' => $this->company->id,
            'branch_id' => $this->branch->id,
            'is_active' => true,
        ]);

        $response = $this->get(route('organization.brand.edit', $brand->id));

        $response->assertStatus(200);
        $response->assertInertia(fn (Assert $page) => $page
            ->component('organization/brand/edit')
            ->has('brand')
            ->where('brand.id', $brand->id)
            ->where('brand.name', 'Layout Edit Brand')
            ->has('companies')
            ->has('branches')
        );
    }

    /**
     * IMPORT FUNCTIONALITY TESTS
     */
    #[Test]
    public function user_can_download_brand_import_template()
    {
        $response = $this->get(route('organization.brand.import.template'));

        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        $response->assertHeader('Content-Disposition', 'attachment; filename=brand_import_template.xlsx');
    }

    #[Test]
    public function user_can_import_brands_from_excel_file()
    {
        // Create a test file path in the storage/app/public/templates directory
        $templatePath = storage_path('app/public/templates/test_brand_import.xlsx');

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
            'description' => 'description',
            'is_active' => 'is_active',
        ]);

        // Add test data rows
        $writer->addRow([
            'name' => 'Test Import Brand 1',
            'code' => 'IMPORT001',
            'description' => 'This is import test brand 1',
            'is_active' => 'Yes',
        ]);

        $writer->addRow([
            'name' => 'Test Import Brand 2',
            'code' => 'IMPORT002',
            'description' => 'This is import test brand 2',
            'is_active' => 'No',
        ]);

        $writer->close();

        // Create an uploaded file from the template
        $file = new UploadedFile(
            $templatePath,
            'test_brand_import.xlsx',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            null,
            true
        );

        // Send the import request with company_id and branch_id
        $response = $this->post(route('organization.brand.import.process'), [
            'file' => $file,
            'company_id' => $this->company->id,
            'branch_id' => $this->branch->id,
        ]);

        // Assert the response is successful
        $response->assertSessionHas('success');

        // Assert the data was imported
        $this->assertDatabaseHas('brands', [
            'name' => 'Test Import Brand 1',
            'code' => 'IMPORT001',
            'is_active' => 1,
            'company_id' => $this->company->id,
            'branch_id' => $this->branch->id,
        ]);

        $this->assertDatabaseHas('brands', [
            'name' => 'Test Import Brand 2',
            'code' => 'IMPORT002',
            'is_active' => 0,
            'company_id' => $this->company->id,
            'branch_id' => $this->branch->id,
        ]);
    }

    #[Test]
    public function import_validates_required_fields()
    {
        // Create a test file path in the storage/app/public/templates directory
        $templatePath = storage_path('app/public/templates/invalid_brand_import.xlsx');

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
            'description' => 'description',
            'is_active' => 'is_active',
        ]);

        // Add invalid data (missing required code)
        $writer->addRow([
            'name' => 'Invalid Brand',
            'code' => '', // Missing required code
            'description' => 'This is an invalid test brand',
            'is_active' => 'Yes',
        ]);

        $writer->close();

        // Create an uploaded file from the template
        $file = new UploadedFile(
            $templatePath,
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

        // Assert the invalid data was not imported
        $this->assertDatabaseMissing('brands', [
            'name' => 'Invalid Brand',
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
        $response = $this->post(route('organization.brand.import.process'), [
            'file' => $file,
            'company_id' => $this->company->id,
            'branch_id' => $this->branch->id,
        ]);

        // Assert validation error
        $response->assertSessionHasErrors('file');
    }

    #[Test]
    public function import_validates_company_and_branch_ids()
    {
        // Create a test file path in the storage/app/public/templates directory
        $templatePath = storage_path('app/public/templates/valid_brand_import.xlsx');

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
            'description' => 'description',
            'is_active' => 'is_active',
        ]);

        // Add valid data
        $writer->addRow([
            'name' => 'Valid Brand',
            'code' => 'VALID001',
            'description' => 'This is a valid test brand',
            'is_active' => 'Yes',
        ]);

        $writer->close();

        // Create an uploaded file from the template
        $file = new UploadedFile(
            $templatePath,
            'valid_brand_import.xlsx',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            null,
            true
        );

        // Send the import request without company_id and branch_id
        $response = $this->post(route('organization.brand.import.process'), [
            'file' => $file,
            // Missing company_id and branch_id
        ]);

        // Assert validation errors
        $response->assertSessionHasErrors(['company_id', 'branch_id']);

        // Assert the data was not imported
        $this->assertDatabaseMissing('brands', [
            'name' => 'Valid Brand',
            'code' => 'VALID001',
        ]);
    }

    #[Test]
    public function import_handles_duplicate_codes()
    {
        // Create an existing brand
        $existingBrand = Brand::create([
            'name' => 'Existing Brand',
            'code' => 'DUPLICATE',
            'company_id' => $this->company->id,
            'branch_id' => $this->branch->id,
            'is_active' => true,
        ]);

        // Create a test file path in the storage/app/public/templates directory
        $templatePath = storage_path('app/public/templates/duplicate_brand_import.xlsx');

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
            'name' => 'Duplicate Code Brand',
            'code' => 'DUPLICATE', // Already exists
            'is_active' => 'Yes',
        ]);

        $writer->close();

        // Create an uploaded file from the template
        $file = new UploadedFile(
            $templatePath,
            'duplicate_brand_import.xlsx',
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

        // Assert the duplicate data was not imported
        $this->assertEquals(1, Brand::where('code', 'DUPLICATE')->count());
    }
}
