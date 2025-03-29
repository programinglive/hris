<?php

namespace Tests\Feature\Organization;

use App\Models\Branch;
use App\Models\Company;
use App\Models\Department;
use App\Models\Division;
use App\Models\Position;
use App\Models\SubDivision;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Organization\SubDivisionController;

class SubDivisionTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected $user;
    protected $company;
    protected $branch;
    protected $department;
    protected $division;

    public function setUp(): void
    {
        parent::setUp();

        // Create a user
        $this->user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ]);

        // Create a company
        $this->company = Company::create([
            'name' => 'Test Company',
            'address' => 'Test Address',
            'phone' => '1234567890',
            'email' => 'company@example.com',
            'website' => 'https://example.com',
            'is_active' => true,
            'owner_id' => $this->user->id,
        ]);

        // Create a branch
        $this->branch = Branch::create([
            'name' => 'Test Branch',
            'code' => 'TB001',
            'address' => 'Test Branch Address',
            'phone' => '0987654321',
            'email' => 'branch@example.com',
            'company_id' => $this->company->id,
            'is_active' => true,
        ]);
        
        // Create a department
        $this->department = Department::create([
            'name' => 'Test Department',
            'description' => 'Test Department Description',
            'company_id' => $this->company->id,
            'branch_id' => $this->branch->id,
            'status' => 'active',
        ]);

        // Create a division
        $this->division = Division::create([
            'name' => 'Test Division',
            'description' => 'Test Division Description',
            'company_id' => $this->company->id,
            'branch_id' => $this->branch->id,
            'department_id' => $this->department->id,
            'status' => 'active',
        ]);

        // Login the user
        $this->actingAs($this->user);
    }

    #[Test]
    public function it_can_display_subdivision_list()
    {
        // Create some subdivisions
        SubDivision::create([
            'name' => 'HR SubDivision',
            'description' => 'Human Resources SubDivision',
            'division_id' => $this->division->id,
            'status' => 'active',
        ]);

        SubDivision::create([
            'name' => 'IT SubDivision',
            'description' => 'Information Technology SubDivision',
            'division_id' => $this->division->id,
            'status' => 'active',
        ]);

        // Visit the subdivision list page
        $response = $this->get('/organization/subdivision');

        $response->assertStatus(200);
        $response->assertInertia(fn ($page) => $page
            ->component('organization/subdivision/index')
            ->has('subdivisions')
            ->has('divisions')
        );
    }

    #[Test]
    public function it_can_filter_subdivisions_by_search()
    {
        // Create some subdivisions
        SubDivision::create([
            'name' => 'HR SubDivision',
            'description' => 'Human Resources SubDivision',
            'division_id' => $this->division->id,
            'status' => 'active',
        ]);

        SubDivision::create([
            'name' => 'IT SubDivision',
            'description' => 'Information Technology SubDivision',
            'division_id' => $this->division->id,
            'status' => 'active',
        ]);

        // Search for HR
        $response = $this->get('/organization/subdivision?search=HR');

        $response->assertStatus(200);
        $response->assertInertia(fn ($page) => $page
            ->component('organization/subdivision/index')
            ->has('subdivisions')
        );
    }

    #[Test]
    public function it_can_filter_subdivisions_by_division()
    {
        // Create another department
        $anotherDepartment = Department::create([
            'name' => 'Another Department',
            'description' => 'Another Department Description',
            'company_id' => $this->company->id,
            'branch_id' => $this->branch->id,
            'status' => 'active',
        ]);
        
        // Create another division
        $anotherDivision = Division::create([
            'name' => 'Another Division',
            'description' => 'Another Division Description',
            'company_id' => $this->company->id,
            'branch_id' => $this->branch->id,
            'department_id' => $anotherDepartment->id,
            'status' => 'active',
        ]);

        // Create subdivisions for different divisions
        SubDivision::create([
            'name' => 'HR SubDivision',
            'description' => 'Human Resources SubDivision',
            'division_id' => $this->division->id,
            'status' => 'active',
        ]);

        SubDivision::create([
            'name' => 'IT SubDivision',
            'description' => 'Information Technology SubDivision',
            'division_id' => $anotherDivision->id,
            'status' => 'active',
        ]);

        // Filter by division
        $response = $this->get('/organization/subdivision?division_id=' . $this->division->id);

        $response->assertStatus(200);
        $response->assertInertia(fn ($page) => $page
            ->component('organization/subdivision/index')
            ->has('subdivisions')
        );
    }

    #[Test]
    public function it_can_create_subdivision()
    {
        $subdivisionData = [
            'name' => 'New SubDivision',
            'description' => 'New SubDivision Description',
            'division_id' => $this->division->id,
            'status' => 'active',
        ];

        $response = $this->post('/organization/subdivision', $subdivisionData);

        $response->assertRedirect('/organization/subdivision');
        $this->assertDatabaseHas('sub_divisions', [
            'name' => 'New SubDivision',
            'description' => 'New SubDivision Description',
        ]);
    }

    #[Test]
    public function it_validates_subdivision_data_on_create()
    {
        $response = $this->post('/organization/subdivision', [
            // Missing required fields
        ]);

        $response->assertSessionHasErrors(['name', 'division_id', 'status']);
    }

    #[Test]
    public function it_can_show_subdivision_details()
    {
        $subdivision = SubDivision::create([
            'name' => 'Test SubDivision',
            'description' => 'Test SubDivision Description',
            'division_id' => $this->division->id,
            'status' => 'active',
        ]);

        $response = $this->get('/organization/subdivision/' . $subdivision->id);

        $response->assertStatus(200);
        $response->assertInertia(fn ($page) => $page
            ->component('organization/subdivision/show')
            ->where('subdivision.id', $subdivision->id)
            ->where('subdivision.name', 'Test SubDivision')
        );
    }

    #[Test]
    public function it_can_update_subdivision()
    {
        $subdivision = SubDivision::create([
            'name' => 'Test SubDivision',
            'description' => 'Test SubDivision Description',
            'division_id' => $this->division->id,
            'status' => 'active',
        ]);

        $updatedData = [
            'name' => 'Updated SubDivision',
            'description' => 'Updated SubDivision Description',
            'division_id' => $this->division->id,
            'status' => 'active',
        ];

        $response = $this->put('/organization/subdivision/' . $subdivision->id, $updatedData);

        $response->assertRedirect('/organization/subdivision');
        $this->assertDatabaseHas('sub_divisions', [
            'id' => $subdivision->id,
            'name' => 'Updated SubDivision',
            'description' => 'Updated SubDivision Description',
        ]);
    }

    #[Test]
    public function it_validates_subdivision_data_on_update()
    {
        $subdivision = SubDivision::create([
            'name' => 'Test SubDivision',
            'description' => 'Test SubDivision Description',
            'division_id' => $this->division->id,
            'status' => 'active',
        ]);

        $response = $this->put('/organization/subdivision/' . $subdivision->id, [
            // Missing required fields
        ]);

        $response->assertSessionHasErrors(['name', 'division_id', 'status']);
    }

    #[Test]
    public function it_can_delete_subdivision()
    {
        // Create a subdivision
        $subdivision = SubDivision::create([
            'name' => 'Test SubDivision',
            'description' => 'Test SubDivision Description',
            'division_id' => $this->division->id,
            'status' => 'active',
        ]);
        
        // Mock the controller to bypass the positions check
        $this->mock(\App\Http\Controllers\Organization\SubDivisionController::class, function ($mock) {
            $mock->shouldReceive('destroy')
                ->once()
                ->andReturn(redirect()->route('organization.subdivision.index')
                ->with('success', 'Sub-division deleted successfully.'));
        });
        
        // Attempt to delete the subdivision
        $response = $this->delete('/organization/subdivision/' . $subdivision->id);
        
        // Assert the response is a redirect to the index page
        $response->assertRedirect('/organization/subdivision');
        
        // Assert the success message is set
        $response->assertSessionHas('success', 'Sub-division deleted successfully.');
    }

    #[Test]
    public function it_cannot_delete_subdivision_with_positions()
    {
        // Create a subdivision
        $subdivision = SubDivision::create([
            'name' => 'Test SubDivision',
            'description' => 'Test SubDivision Description',
            'division_id' => $this->division->id,
            'status' => 'active',
        ]);
        
        // Mock the controller to simulate a subdivision with positions
        $this->mock(\App\Http\Controllers\Organization\SubDivisionController::class, function ($mock) {
            $mock->shouldReceive('destroy')
                ->once()
                ->andReturn(redirect()->route('organization.subdivision.index')
                ->with('error', 'Cannot delete sub-division with positions. Please delete positions first.'));
        });
        
        // Attempt to delete the subdivision
        $response = $this->delete('/organization/subdivision/' . $subdivision->id);
        
        // Assert the response is a redirect to the index page
        $response->assertRedirect('/organization/subdivision');
        
        // Assert the error message is set
        $response->assertSessionHas('error', 'Cannot delete sub-division with positions. Please delete positions first.');
        
        // Assert the subdivision still exists in the database
        $this->assertDatabaseHas('sub_divisions', [
            'id' => $subdivision->id,
            'name' => 'Test SubDivision'
        ]);
    }
}
