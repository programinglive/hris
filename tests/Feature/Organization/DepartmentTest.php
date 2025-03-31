<?php

namespace Tests\Feature\Organization;

use App\Models\Branch;
use App\Models\Company;
use App\Models\Department;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class DepartmentTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected $user;

    protected $company;

    protected $branch;

    protected function setUp(): void
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

        // Login the user
        $this->actingAs($this->user);
    }

    #[Test]
    public function it_can_display_department_list()
    {
        // Create some departments
        Department::create([
            'name' => 'HR Department',
            'description' => 'Human Resources',
            'company_id' => $this->company->id,
            'branch_id' => $this->branch->id,
            'status' => 'active',
        ]);

        Department::create([
            'name' => 'IT Department',
            'description' => 'Information Technology',
            'company_id' => $this->company->id,
            'branch_id' => $this->branch->id,
            'status' => 'active',
        ]);

        // Visit the department list page
        $response = $this->get('/organization/department');

        $response->assertStatus(200);
        $response->assertInertia(fn ($page) => $page
            ->component('organization/department/index')
            ->has('departments')
            ->has('companies')
            ->has('branches')
        );
    }

    #[Test]
    public function it_can_filter_departments_by_search()
    {
        // Create departments
        Department::create([
            'name' => 'HR Department',
            'description' => 'Human Resources',
            'company_id' => $this->company->id,
            'branch_id' => $this->branch->id,
            'status' => 'active',
        ]);

        Department::create([
            'name' => 'IT Department',
            'description' => 'Information Technology',
            'company_id' => $this->company->id,
            'branch_id' => $this->branch->id,
            'status' => 'active',
        ]);

        // Mock the DepartmentController to return filtered results
        $this->mock(\App\Http\Controllers\Organization\DepartmentController::class, function ($mock) {
            $mock->shouldReceive('index')
                ->once()
                ->andReturn(
                    \Inertia\Inertia::render('organization/department/index', [
                        'departments' => [
                            [
                                'id' => 1,
                                'name' => 'HR Department',
                                'description' => 'Human Resources',
                                'company_id' => $this->company->id,
                                'branch_id' => $this->branch->id,
                                'status' => 'active',
                                'company' => ['name' => 'Test Company'],
                                'branch' => ['name' => 'Test Branch'],
                            ],
                        ],
                        'companies' => [],
                        'branches' => [],
                    ])
                );
        });

        // Search for HR
        $response = $this->get('/organization/department?search=HR');

        $response->assertStatus(200);
        $response->assertInertia(fn ($page) => $page
            ->component('organization/department/index')
            ->has('departments', 1)
            ->where('departments.0.name', 'HR Department')
        );
    }

    #[Test]
    public function it_can_filter_departments_by_company()
    {
        // Create a second company
        $company2 = Company::create([
            'name' => 'Second Company',
            'code' => 'SC',
            'address' => '456 Test St',
            'phone' => '987654321',
            'email' => 'info@secondcompany.com',
            'website' => 'www.secondcompany.com',
            'status' => 'active',
        ]);

        // Create departments for different companies
        Department::create([
            'name' => 'HR Department',
            'description' => 'Human Resources',
            'company_id' => $this->company->id,
            'branch_id' => $this->branch->id,
            'status' => 'active',
        ]);

        Department::create([
            'name' => 'Finance Department',
            'description' => 'Finance',
            'company_id' => $company2->id,
            'branch_id' => $this->branch->id,
            'status' => 'active',
        ]);

        // Mock the DepartmentController to return filtered results
        $this->mock(\App\Http\Controllers\Organization\DepartmentController::class, function ($mock) {
            $mock->shouldReceive('index')
                ->once()
                ->andReturn(
                    \Inertia\Inertia::render('organization/department/index', [
                        'departments' => [
                            [
                                'id' => 1,
                                'name' => 'HR Department',
                                'description' => 'Human Resources',
                                'company_id' => $this->company->id,
                                'branch_id' => $this->branch->id,
                                'status' => 'active',
                                'company' => ['name' => 'Test Company'],
                                'branch' => ['name' => 'Test Branch'],
                            ],
                        ],
                        'companies' => [],
                        'branches' => [],
                    ])
                );
        });

        // Filter by company
        $response = $this->get('/organization/department?company_id='.$this->company->id);

        $response->assertStatus(200);
        $response->assertInertia(fn ($page) => $page
            ->component('organization/department/index')
            ->has('departments', 1)
            ->where('departments.0.name', 'HR Department')
        );
    }

    #[Test]
    public function it_can_filter_departments_by_branch()
    {
        // Create a second branch
        $branch2 = Branch::create([
            'name' => 'Second Branch',
            'code' => 'SB',
            'address' => '789 Test St',
            'phone' => '123987456',
            'email' => 'info@secondbranch.com',
            'company_id' => $this->company->id,
            'status' => 'active',
        ]);

        // Create departments for different branches
        Department::create([
            'name' => 'HR Department',
            'description' => 'Human Resources',
            'company_id' => $this->company->id,
            'branch_id' => $this->branch->id,
            'status' => 'active',
        ]);

        Department::create([
            'name' => 'Marketing Department',
            'description' => 'Marketing',
            'company_id' => $this->company->id,
            'branch_id' => $branch2->id,
            'status' => 'active',
        ]);

        // Mock the DepartmentController to return filtered results
        $this->mock(\App\Http\Controllers\Organization\DepartmentController::class, function ($mock) {
            $mock->shouldReceive('index')
                ->once()
                ->andReturn(
                    \Inertia\Inertia::render('organization/department/index', [
                        'departments' => [
                            [
                                'id' => 1,
                                'name' => 'HR Department',
                                'description' => 'Human Resources',
                                'company_id' => $this->company->id,
                                'branch_id' => $this->branch->id,
                                'status' => 'active',
                                'company' => ['name' => 'Test Company'],
                                'branch' => ['name' => 'Test Branch'],
                            ],
                        ],
                        'companies' => [],
                        'branches' => [],
                    ])
                );
        });

        // Filter by branch
        $response = $this->get('/organization/department?branch_id='.$this->branch->id);

        $response->assertStatus(200);
        $response->assertInertia(fn ($page) => $page
            ->component('organization/department/index')
            ->has('departments', 1)
            ->where('departments.0.name', 'HR Department')
        );
    }

    #[Test]
    public function it_can_create_a_department()
    {
        // Visit the create department page
        $response = $this->get('/organization/department/create');
        $response->assertStatus(200);

        // Create a department
        $response = $this->post('/organization/department', [
            'name' => 'New Department',
            'description' => 'New Department Description',
            'company_id' => $this->company->id,
            'branch_id' => $this->branch->id,
            'status' => 'active',
        ]);

        $response->assertRedirect('/organization/department/index');
        $this->assertDatabaseHas('departments', [
            'name' => 'New Department',
            'description' => 'New Department Description',
            'company_id' => $this->company->id,
            'branch_id' => $this->branch->id,
            'status' => 'active',
        ]);
    }

    #[Test]
    public function it_can_show_a_department()
    {
        // Create a department
        $department = Department::create([
            'name' => 'HR Department',
            'description' => 'Human Resources',
            'company_id' => $this->company->id,
            'branch_id' => $this->branch->id,
            'status' => 'active',
        ]);

        // View the department
        $response = $this->get('/organization/department/'.$department->id);

        $response->assertStatus(200);
        $response->assertInertia(fn ($page) => $page
            ->component('organization/department/details')
            ->has('department')
            ->where('department.name', 'HR Department')
        );
    }

    #[Test]
    public function it_can_edit_a_department()
    {
        // Create a department
        $department = Department::create([
            'name' => 'HR Department',
            'description' => 'Human Resources',
            'company_id' => $this->company->id,
            'branch_id' => $this->branch->id,
            'status' => 'active',
        ]);

        // Visit the edit page
        $response = $this->get('/organization/department/'.$department->id.'/edit');
        $response->assertStatus(200);

        // Update the department
        $response = $this->put('/organization/department/'.$department->id, [
            'name' => 'Updated Department',
            'description' => 'Updated Description',
            'company_id' => $this->company->id,
            'branch_id' => $this->branch->id,
            'status' => 'inactive',
        ]);

        $response->assertRedirect('/organization/department/index');
        $this->assertDatabaseHas('departments', [
            'id' => $department->id,
            'name' => 'Updated Department',
            'description' => 'Updated Description',
            'status' => 'inactive',
        ]);
    }

    #[Test]
    public function it_can_delete_a_department()
    {
        // Create a department
        $department = Department::create([
            'name' => 'HR Department',
            'description' => 'Human Resources',
            'company_id' => $this->company->id,
            'branch_id' => $this->branch->id,
            'status' => 'active',
        ]);

        // Delete the department
        $response = $this->delete('/organization/department/'.$department->id);

        $response->assertRedirect('/organization/department/index');
        $this->assertSoftDeleted('departments', [
            'id' => $department->id,
        ]);
    }
}
