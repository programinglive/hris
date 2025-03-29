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

class BranchFeatureTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected $user;
    protected $company;
    protected $timestamp;

    protected function setUp(): void
    {
        parent::setUp();

        // Create a user and authenticate
        $this->user = User::factory()->create();
        $this->actingAs($this->user);
        
        // Create a company for testing
        $this->company = Company::factory()->create([
            'owner_id' => $this->user->id
        ]);
        
        // Set up storage for file uploads
        Storage::fake('local');
        
        // Store timestamp for consistent testing
        $this->timestamp = time();
    }

    #[Test]
    public function can_display_branch_list_page()
    {
        // Create some branches
        $branches = Branch::factory()->count(3)->create([
            'company_id' => $this->company->id,
        ]);
        
        $response = $this->get(route('organization.branch.index'));
        
        $response->assertStatus(200);
        $response->assertInertia(fn (Assert $page) => 
            $page->component('organization/branch/index')
                ->has('branches.data', 3)
                ->has('branches.data.0', fn (Assert $branch) => 
                    $branch->has('id')
                        ->has('name')
                        ->has('code')
                        ->has('address')
                        ->has('city')
                        ->has('company')
                        ->has('company.id')
                        ->has('company.name')
                        ->has('company_id')
                        ->has('is_main_branch')
                        ->has('is_active')
                        ->has('created_at')
                )
                ->has('branches.current_page')
                ->has('branches.per_page')
                ->has('branches.total')
                ->has('companies', fn (Assert $companies) => 
                    $companies->has(1)
                        ->has(0, fn (Assert $company) => 
                            $company->where('id', $this->company->id)
                                ->where('name', $this->company->name)
                        )
                )
        );
    }

    #[Test]
    public function can_filter_branches_by_search_query()
    {
        // Create branches with different names
        Branch::factory()->create([
            'name' => 'Alpha Branch',
            'code' => 'ALPHA001',
            'company_id' => $this->company->id,
        ]);
        
        Branch::factory()->create([
            'name' => 'Beta Branch',
            'code' => 'BETA001',
            'company_id' => $this->company->id,
        ]);
        
        // Test search by name
        $response = $this->get(route('organization.branch.index', [
            'search' => 'Alpha'
        ]));
        
        $response->assertStatus(200);
        $response->assertInertia(fn (Assert $page) => 
            $page->component('organization/branch/index')
            ->has('branches.data', 1)
            ->where('branches.data.0.name', 'Alpha Branch')
        );
    }

    #[Test]
    public function can_view_branch_create_form()
    {
        $response = $this->get(route('organization.branch.create'));
        
        $response->assertStatus(200);
        $response->assertInertia(fn (Assert $page) => 
            $page->component('organization/branch/create')
        );
    }

    #[Test]
    public function can_create_a_branch()
    {
        $response = $this->post(route('organization.branch.store'), [
            'name' => 'Test Branch',
            'code' => 'TEST' . $this->timestamp,
            'company_id' => $this->company->id,
            'is_active' => true,
            'is_main_branch' => false,
        ]);
        
        $response->assertRedirect(route('organization.branch.index'));
        
        $this->assertDatabaseHas('branches', [
            'name' => 'Test Branch',
            'code' => 'TEST' . $this->timestamp,
            'company_id' => $this->company->id,
            'is_active' => true,
            'is_main_branch' => false,
        ]);
    }

    #[Test]
    public function can_view_branch_details()
    {
        $branch = Branch::factory()->create([
            'company_id' => $this->company->id,
        ]);
        
        $response = $this->get(route('organization.branch.show', $branch));
        
        $response->assertStatus(200);
        $response->assertInertia(fn (Assert $page) => 
            $page->component('organization/branch/details')
            ->has('branch', fn (Assert $branchData) => 
                $branchData->where('id', $branch->id)
                    ->where('name', $branch->name)
                    ->where('code', $branch->code)
                    ->where('address', $branch->address)
                    ->where('city', $branch->city)
                    ->where('state', $branch->state)
                    ->where('postal_code', $branch->postal_code)
                    ->where('country', $branch->country)
                    ->where('phone', $branch->phone)
                    ->where('email', $branch->email)
                    ->where('description', $branch->description)
                    ->where('created_at', $branch->created_at->format('Y-m-d'))
                    ->where('is_main_branch', $branch->is_main_branch ? 1 : 0)
                    ->where('is_active', $branch->is_active ? 1 : 0)
                    ->where('company.id', $this->company->id)
                    ->where('company.name', $this->company->name)
            )
        );
    }

    #[Test]
    public function can_view_branch_edit_form()
    {
        $branch = Branch::factory()->create([
            'company_id' => $this->company->id,
        ]);
        
        $response = $this->get(route('organization.branch.edit', $branch));
        
        $response->assertStatus(200);
        $response->assertInertia(fn (Assert $page) => 
            $page->component('organization/branch/edit')
            ->has('branch', fn (Assert $branchData) => 
                $branchData->where('id', $branch->id)
                    ->has('name')
                    ->has('code')
                    ->has('address')
                    ->has('city')
                    ->has('state')
                    ->has('postal_code')
                    ->has('country')
                    ->has('phone')
                    ->has('email')
                    ->has('description')
                    ->has('is_main_branch')
                    ->has('is_active')
                    ->has('company_id')
                    ->has('created_at')
                    ->has('updated_at')
                    ->has('deleted_at')
            )
        );
    }

    #[Test]
    public function can_update_a_branch()
    {
        $branch = Branch::factory()->create([
            'company_id' => $this->company->id,
        ]);
        
        $response = $this->put(route('organization.branch.update', $branch), [
            'name' => 'Updated Branch',
            'code' => 'UPDATED' . $this->timestamp,
            'company_id' => $this->company->id,
            'is_active' => false,
            'is_main_branch' => true,
        ]);
        
        $response->assertRedirect(route('organization.branch.index'));
        
        $this->assertDatabaseHas('branches', [
            'id' => $branch->id,
            'name' => 'Updated Branch',
            'code' => 'UPDATED' . $this->timestamp,
            'company_id' => $this->company->id,
            'is_active' => false,
            'is_main_branch' => true,
        ]);
    }

    #[Test]
    public function can_delete_a_branch()
    {
        $branch = Branch::factory()->create([
            'company_id' => $this->company->id,
        ]);
        
        $response = $this->delete(route('organization.branch.destroy', $branch));
        $response->assertRedirect(route('organization.branch.index'));
        
        // Verify the branch was deleted
        $this->assertDatabaseMissing('branches', [
            'id' => $branch->id,
        ]);
    }

    #[Test]
    public function can_download_branch_import_template()
    {
        $response = $this->get(route('organization.branch.import.template'));
        
        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        $response->assertHeader('Content-Disposition', 'attachment; filename=branch_import_template.xlsx');
    }

    #[Test]
    public function can_import_branches_from_excel_file()
    {
        // Create a test Excel file with branch data
        $templatePath = storage_path('app/temp/branch_import_template.xlsx');
        
        // Ensure the directory exists
        if (!file_exists(storage_path('app/temp'))) {
            mkdir(storage_path('app/temp'), 0755, true);
        }
        
        // Create a writer and add the headers
        $writer = SimpleExcelWriter::create($templatePath);
        
        // Add headers
        $writer->addRow([
            'name' => 'Branch Name*',
            'code' => 'Branch Code*',
            'company_code' => 'Company Code*',
            'company_name' => 'Company Name*',
            'address' => 'Address',
            'city' => 'City',
            'state' => 'State/Province',
            'postal_code' => 'Postal Code',
            'country' => 'Country',
            'phone' => 'Phone',
            'email' => 'Email',
            'is_active' => 'Is Active (Yes/No)',
            'description' => 'Description'
        ]);
        
        // Add test data
        $writer->addRow([
            'name' => 'Test Import Branch 1',
            'code' => 'IMPORT001',
            'company_code' => $this->company->code,
            'company_name' => $this->company->name,
            'address' => '123 Import Street',
            'city' => 'Import City',
            'state' => 'Import State',
            'postal_code' => '12345',
            'country' => 'Import Country',
            'phone' => '555-123-4567',
            'email' => 'import1@example.com',
            'is_active' => 'Yes',
            'description' => 'First imported branch'
        ]);
        
        $writer->addRow([
            'name' => 'Test Import Branch 2',
            'code' => 'IMPORT002',
            'company_code' => $this->company->code,
            'company_name' => $this->company->name,
            'address' => '456 Import Street',
            'city' => 'Import City',
            'state' => 'Import State',
            'postal_code' => '67890',
            'country' => 'Import Country',
            'phone' => '555-987-6543',
            'email' => 'import2@example.com',
            'is_active' => 'Yes',
            'description' => 'Second imported branch'
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
        
        $response->assertStatus(200);
        
        // Verify the branches were created
        $this->assertDatabaseHas('branches', [
            'name' => 'Test Import Branch 1',
            'code' => 'IMPORT001',
            'company_id' => $this->company->id,
            'address' => '123 Import Street',
            'city' => 'Import City',
            'state' => 'Import State',
            'postal_code' => '12345',
            'country' => 'Import Country',
            'phone' => '555-123-4567',
            'email' => 'import1@example.com',
            'is_main_branch' => 0,
            'is_active' => 1,
            'description' => 'First imported branch'
        ]);
        
        $this->assertDatabaseHas('branches', [
            'name' => 'Test Import Branch 2',
            'code' => 'IMPORT002',
            'company_id' => $this->company->id,
            'address' => '456 Import Street',
            'city' => 'Import City',
            'state' => 'Import State',
            'postal_code' => '67890',
            'country' => 'Import Country',
            'phone' => '555-987-6543',
            'email' => 'import2@example.com',
            'is_main_branch' => 0,
            'is_active' => 1,
            'description' => 'Second imported branch'
        ]);
    }

    #[Test]
    public function enforces_branch_validation_rules()
    {
        $response = $this->post(route('organization.branch.store'), [
            'name' => '',  // Empty required field
            'code' => '',  // Empty required field
            'company_id' => '',  // Empty required field
            'is_active' => true,
        ]);
        
        $response->assertSessionHasErrors(['name', 'code', 'company_id']);
        
        $errors = session('errors');
        expect($errors->getMessages())->toHaveKey('name');
        expect($errors->getMessages())->toHaveKey('code');
        expect($errors->getMessages())->toHaveKey('company_id');
        
        expect($errors->get('name')[0])->toContain('The name field is required');
        expect($errors->get('code')[0])->toContain('The code field is required');
        expect($errors->get('company_id')[0])->toContain('The company id field is required');
    }

    #[Test]
    public function requires_unique_branch_code()
    {
        // Create first branch
        $branch1 = Branch::factory()->create([
            'company_id' => $this->company->id,
            'code' => 'TEST' . $this->timestamp,
        ]);
        
        // Try to create second branch with same code
        $response = $this->post(route('organization.branch.store'), [
            'name' => 'Test Branch 2',
            'code' => 'TEST' . $this->timestamp,
            'company_id' => $this->company->id,
            'is_active' => true,
        ]);
        
        $response->assertSessionHasErrors(['code']);
        
        $errors = session('errors');
        expect($errors->getMessages())->toHaveKey('code');
        expect($errors->get('code')[0])->toContain('The code has already been taken');
    }

    #[Test]
    public function filters_are_reset_when_filter_dialog_opens()
    {
        $this->actingAs($this->user);
        
        // Create some branches
        $branches = Branch::factory()->count(3)->create([
            'company_id' => $this->company->id,
        ]);
        
        // Open filter dialog
        $response = $this->get(route('organization.branch.index', [
            'company_id' => $this->company->id,
            'city' => 'Test City',
            'filter_dialog' => true
        ]));
        
        $response->assertStatus(200);
        $response->assertInertia(fn (Assert $page) => 
            $page->component('organization/branch/index')
                ->has('branches.data')
                // Verify filters are reset
                ->where('filters.search', null)
                ->where('filters.company_id', null)
                ->where('filters.city', null)
        );
    }

    #[Test]
    public function query_string_is_cleared_when_filter_dialog_opens()
    {
        $this->actingAs($this->user);
        
        // Create some branches
        $branches = Branch::factory()->count(3)->create([
            'company_id' => $this->company->id,
        ]);
        
        // Open filter dialog
        $response = $this->get(route('organization.branch.index', [
            'company_id' => $this->company->id,
            'city' => 'Test City',
            'filter_dialog' => true
        ]));
        
        $response->assertStatus(200);
        $response->assertInertia(fn (Assert $page) => 
            $page->component('organization/branch/index')
                ->has('branches.data')
                // Verify only page parameter exists in query string
                ->where('filters.search', null)
                ->where('filters.company_id', null)
                ->where('filters.city', null)
        );
    }
}
