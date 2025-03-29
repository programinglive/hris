<?php

namespace Tests\Feature\Employee;

use App\Models\User;
use App\Models\UserDetail;
use App\Models\Company;
use App\Models\Department;
use App\Models\Position;
use App\Models\Branch;
use App\Models\Role;
use App\Models\Division;
use App\Models\SubDivision;
use App\Models\Level;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class EmployeeCrudTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected $user;
    protected $company;
    protected $branch;
    protected $adminRole;

    public function setUp(): void
    {
        parent::setUp();
        
        // Create a company
        $this->company = Company::factory()->create([
            'name' => 'Test Company',
            'is_active' => true,
        ]);
        
        // Create a branch
        $this->branch = Branch::factory()->create([
            'company_id' => $this->company->id,
            'name' => 'Main Branch',
            'is_main_branch' => true,
        ]);
        
        // Create and assign admin role
        $this->adminRole = Role::create([
            'name' => 'administrator',
            'display_name' => 'Administrator',
            'description' => 'Full access to all system features',
        ]);
        
        // Create a user for authentication
        $this->user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ]);
        
        // Assign role to user
        $this->user->roles()->attach($this->adminRole->id);
        
        // Create user detail with company association
        UserDetail::create([
            'user_id' => $this->user->id,
            'employee_id' => 'EMP001',
            'company_id' => $this->company->id,
            'branch_id' => $this->branch->id,
            'status' => 'Active',
        ]);
    }

    #[Test]
    public function test_user_can_view_employee_list(): void
    {
        // Create some employees
        for ($i = 0; $i < 5; $i++) {
            $employee = User::factory()->create([
                'name' => "Test Employee $i",
                'email' => "employee$i@example.com",
            ]);
            
            $employee->roles()->attach($this->adminRole->id);
            
            UserDetail::create([
                'user_id' => $employee->id,
                'employee_id' => "EMP00" . ($i + 2),
                'company_id' => $this->company->id,
                'branch_id' => $this->branch->id,
                'status' => 'Active',
            ]);
        }

        // Act: Visit the employee list page
        $response = $this->actingAs($this->user)
            ->get(route('employee.index'));

        // Assert: Page loads successfully and contains employee data
        $response->assertStatus(200);
        $response->assertInertia(fn ($page) => $page
            ->component('employee/index')
            ->has('employees')
        );
    }

    #[Test]
    public function test_user_can_create_employee(): void
    {
        // Create test data
        $department = Department::create([
            'company_id' => $this->company->id,
            'name' => 'Test Department',
            'description' => 'Test Department Description',
            'status' => 'active',
        ]);

        // Create a division
        $division = Division::create([
            'name' => 'Test Division',
            'code' => 'TDV',
            'description' => 'Test Division Description',
            'department_id' => $department->id,
            'company_id' => $this->company->id,
            'status' => 'active',
        ]);

        // Create a subdivision
        $subdivision = SubDivision::create([
            'name' => 'Test SubDivision',
            'code' => 'TSD',
            'description' => 'Test SubDivision Description',
            'division_id' => $division->id,
            'status' => 'active',
        ]);

        // Create a level
        $level = Level::create([
            'name' => 'Test Level',
            'code' => 'TLV',
            'description' => 'Test Level Description',
            'level_order' => 1,
            'company_id' => $this->company->id,
            'status' => 'active',
        ]);

        $position = Position::create([
            'company_id' => $this->company->id,
            'name' => 'Test Position',
            'code' => 'TP-001',
            'description' => 'Test Position Description',
            'level_id' => $level->id,
            'sub_division_id' => $subdivision->id,
            'status' => 'active',
        ]);

        // Employee data
        $employeeData = [
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'employee_id' => 'EMP-' . rand(1000, 9999),
            'position_id' => $position->id,
            'department_id' => $department->id,
            'branch_id' => $this->branch->id,
            'join_date' => now()->format('Y-m-d'),
            'status' => 'Active',
            'company_id' => $this->company->id,
        ];

        // Act: Submit the form to create an employee
        $response = $this->actingAs($this->user)
            ->post(route('employee.store'), $employeeData);

        // Assert: Redirected to employee list and employee was created
        $response->assertRedirect(route('employee.index'));
        $this->assertDatabaseHas('users', [
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
        ]);
        $this->assertDatabaseHas('user_details', [
            'employee_id' => $employeeData['employee_id'],
            'company_id' => $this->company->id,
        ]);
    }

    #[Test]
    public function test_user_can_update_employee(): void
    {
        // Create an employee to update
        $employee = User::factory()->create([
            'name' => 'Original Name',
            'email' => 'original@example.com',
        ]);

        $employee->roles()->attach($this->adminRole->id);

        $userDetail = UserDetail::create([
            'user_id' => $employee->id,
            'employee_id' => 'EMP-1234',
            'company_id' => $this->company->id,
            'branch_id' => $this->branch->id,
            'status' => 'Active',
        ]);

        // Update data
        $updateData = [
            'name' => 'Updated Name',
            'email' => 'updated@example.com',
            'employee_id' => 'EMP-5678',
            'status' => 'Inactive',
        ];

        // Act: Submit the form to update the employee
        $response = $this->actingAs($this->user)
            ->put(route('employee.update', $employee->id), $updateData);

        // Assert: Redirected to employee list and employee was updated
        $response->assertRedirect(route('employee.index'));
        $this->assertDatabaseHas('users', [
            'id' => $employee->id,
            'name' => 'Updated Name',
            'email' => 'updated@example.com',
        ]);
        $this->assertDatabaseHas('user_details', [
            'user_id' => $employee->id,
            'employee_id' => 'EMP-5678',
            'status' => 'Inactive',
        ]);
    }

    #[Test]
    public function test_user_can_delete_employee(): void
    {
        // Create an employee to delete
        $employee = User::factory()->create();
        $employee->roles()->attach($this->adminRole->id);

        $userDetail = UserDetail::create([
            'user_id' => $employee->id,
            'employee_id' => 'EMP-DELETE',
            'company_id' => $this->company->id,
            'branch_id' => $this->branch->id,
            'status' => 'Active',
        ]);

        // Act: Submit the delete request
        $response = $this->actingAs($this->user)
            ->delete(route('employee.destroy', $employee->id));

        // Assert: Redirected to employee list and employee was deleted
        $response->assertRedirect(route('employee.index'));
        $this->assertDatabaseMissing('users', ['id' => $employee->id]);
        $this->assertDatabaseMissing('user_details', ['user_id' => $employee->id]);
    }

    #[Test]
    public function test_user_can_filter_employees_by_department(): void
    {
        // Create departments
        $department1 = Department::create([
            'company_id' => $this->company->id,
            'name' => 'HR Department',
            'description' => 'Human Resources',
            'status' => 'active',
        ]);

        $department2 = Department::create([
            'company_id' => $this->company->id,
            'name' => 'IT Department',
            'description' => 'Information Technology',
            'status' => 'active',
        ]);

        // Create employees in different departments
        for ($i = 0; $i < 3; $i++) {
            $employee = User::factory()->create();
            $employee->roles()->attach($this->adminRole->id);

            UserDetail::create([
                'user_id' => $employee->id,
                'employee_id' => "EMP-HR-$i",
                'company_id' => $this->company->id,
                'branch_id' => $this->branch->id,
                'department_id' => $department1->id,
                'status' => 'Active',
            ]);
        }

        for ($i = 0; $i < 2; $i++) {
            $employee = User::factory()->create();
            $employee->roles()->attach($this->adminRole->id);

            UserDetail::create([
                'user_id' => $employee->id,
                'employee_id' => "EMP-IT-$i",
                'company_id' => $this->company->id,
                'branch_id' => $this->branch->id,
                'department_id' => $department2->id,
                'status' => 'Active',
            ]);
        }

        // Act: Filter by department
        $response = $this->actingAs($this->user)
            ->get(route('employee.index', ['department' => $department1->id]));

        // Assert: Page loads successfully
        $response->assertStatus(200);
        $response->assertInertia(fn ($page) => $page
            ->component('employee/index')
            ->has('employees')
        );
    }

    #[Test]
    public function test_user_can_sort_employees(): void
    {
        // Create some employees
        for ($i = 0; $i < 5; $i++) {
            $employee = User::factory()->create([
                'name' => chr(65 + $i) . " Test Employee", // A Test Employee, B Test Employee, etc.
            ]);

            $employee->roles()->attach($this->adminRole->id);

            UserDetail::create([
                'user_id' => $employee->id,
                'employee_id' => "EMP-" . (1000 + $i),
                'company_id' => $this->company->id,
                'branch_id' => $this->branch->id,
                'status' => 'Active',
            ]);
        }

        // Act: Sort by name
        $response = $this->actingAs($this->user)
            ->get(route('employee.index', ['sort' => 'name', 'direction' => 'desc']));

        // Assert: Page loads successfully
        $response->assertStatus(200);
        $response->assertInertia(fn ($page) => $page
            ->component('employee/index')
            ->has('employees')
        );
    }

    #[Test]
    public function test_employee_create_page_loads_correctly(): void
    {
        // Act: Visit the employee create page
        $response = $this->actingAs($this->user)
            ->get(route('employee.create'));

        // Assert: Page loads successfully and contains the necessary props
        $response->assertStatus(200);
        $response->assertInertia(fn ($page) => $page
            ->component('employee/create')
            ->has('companies')
            ->has('branches')
            ->has('brands')
            ->has('departments')
            ->has('divisions')
            ->has('subdivisions')
            ->has('positionLevels')
            ->has('departmentNames')
            ->has('positions')
            ->has('statuses')
            ->has('genders')
            ->has('maritalStatuses')
        );
    }

    #[Test]
    public function test_employee_can_be_created_with_none_select_values(): void
    {
        // Create test data
        $department = Department::create([
            'company_id' => $this->company->id,
            'name' => 'Test Department',
            'description' => 'Test Department Description',
            'status' => 'active',
        ]);

        // Employee data with "none" values for select fields
        // These should be converted to empty strings by the frontend before submission
        $employeeData = [
            'name' => 'Jane Smith',
            'email' => 'jane.smith@example.com',
            'password' => 'password',
            'employee_id' => 'EMP-' . rand(1000, 9999),
            'status' => 'Active',
            'company_id' => '', // Empty string simulating "none" value from frontend
            'branch_id' => '', // Empty string simulating "none" value from frontend
            'brand_id' => '', // Empty string simulating "none" value from frontend
            'department_id' => '', // Empty string simulating "none" value from frontend
            'division_id' => '', // Empty string simulating "none" value from frontend
            'sub_division_id' => '', // Empty string simulating "none" value from frontend
            'position_level_id' => '', // Empty string simulating "none" value from frontend
        ];

        // Act: Submit the form to create an employee
        $response = $this->actingAs($this->user)
            ->post(route('employee.store'), $employeeData);

        // Assert: Redirected to employee list and employee was created
        $response->assertRedirect(route('employee.index'));
        $this->assertDatabaseHas('users', [
            'name' => 'Jane Smith',
            'email' => 'jane.smith@example.com',
        ]);

        // Get the created user
        $createdUser = User::where('email', 'jane.smith@example.com')->first();

        // Verify user details were created with null values for the empty select fields
        $this->assertDatabaseHas('user_details', [
            'user_id' => $createdUser->id,
            'employee_id' => $employeeData['employee_id'],
            'company_id' => null,
            'branch_id' => null,
            'department_id' => null,
            'division_id' => null,
            'sub_division_id' => null,
        ]);
    }

    #[Test]
    public function test_employee_crud_buttons_functionality(): void
    {
        // Create an employee to test CRUD operations on
        $employee = User::factory()->create([
            'name' => 'CRUD Test Employee',
            'email' => 'crud.test@example.com',
        ]);

        $employee->roles()->attach($this->adminRole->id);

        $userDetail = UserDetail::create([
            'user_id' => $employee->id,
            'employee_id' => 'EMP-CRUD',
            'company_id' => $this->company->id,
            'branch_id' => $this->branch->id,
            'join_date' => '2024-01-15',
            'exit_date' => '2025-03-20',
            'status' => 'Inactive',
        ]);

        // Test View Button (Simulating clicking "View" in dropdown)
        $viewResponse = $this->actingAs($this->user)
            ->get(route('employee.show', $employee->id));

        $viewResponse->assertStatus(200);
        $viewResponse->assertInertia(fn ($page) => $page
            ->component('employee/details')
            ->has('employee')
            ->where('employee.id', $employee->id)
            ->where('employee.name', 'CRUD Test Employee')
            ->where('employee.email', 'crud.test@example.com')
            ->where('employee.join_date', '2024-01-15')
            ->where('employee.exit_date', '2025-03-20')
            ->where('employee.status', 'Inactive')
        );

        // Test Edit Button (Simulating clicking "Edit" in dropdown)
        $editResponse = $this->actingAs($this->user)
            ->get(route('employee.edit', $employee->id));

        $editResponse->assertStatus(200);
        $editResponse->assertInertia(fn ($page) => $page
            ->component('employee/edit')
            ->has('employee')
            ->where('employee.id', $employee->id)
        );

        // Test Update (Simulating form submission after clicking Edit)
        $updateData = [
            'name' => 'Updated CRUD Employee',
            'email' => 'crud.updated@example.com',
            'employee_id' => 'EMP-CRUD-UPD',
            'join_date' => '2024-01-15',
            'exit_date' => '2025-04-30',
            'status' => 'Inactive',
        ];

        $updateResponse = $this->actingAs($this->user)
            ->put(route('employee.update', $employee->id), $updateData);

        $updateResponse->assertRedirect(route('employee.index'));
        $this->assertDatabaseHas('users', [
            'id' => $employee->id,
            'name' => 'Updated CRUD Employee',
            'email' => 'crud.updated@example.com',
        ]);

        $updatedDetail = UserDetail::where('user_id', $employee->id)->first();
        $this->assertNotNull($updatedDetail);
        $this->assertEquals('EMP-CRUD-UPD', $updatedDetail->employee_id);
        $this->assertEquals('2025-04-30', $updatedDetail->exit_date->format('Y-m-d'));
        $this->assertEquals('Inactive', $updatedDetail->status);

        // Test Delete Button (Simulating clicking "Delete" in dropdown and confirming)
        $deleteResponse = $this->actingAs($this->user)
            ->delete(route('employee.destroy', $employee->id));

        $deleteResponse->assertRedirect(route('employee.index'));

        // Check if the user was deleted (either hard delete or soft delete)
        $this->assertDatabaseMissing('users', [
            'id' => $employee->id,
            'email' => 'crud.updated@example.com',
        ]);
    }

    #[Test]
    public function test_employee_exit_date_functionality(): void
    {
        // Create an employee with join date but no exit date
        $employee = User::factory()->create([
            'name' => 'Exit Date Test Employee',
            'email' => 'exit.test@example.com',
        ]);

        $employee->roles()->attach($this->adminRole->id);

        $userDetail = UserDetail::create([
            'user_id' => $employee->id,
            'employee_id' => 'EMP-EXIT',
            'company_id' => $this->company->id,
            'branch_id' => $this->branch->id,
            'join_date' => '2023-05-15',
            'status' => 'Active',
        ]);

        // Verify the employee details page shows no exit date
        $viewResponse = $this->actingAs($this->user)
            ->get(route('employee.show', $employee->id));

        $viewResponse->assertStatus(200);
        $viewResponse->assertInertia(fn ($page) => $page
            ->component('employee/details')
            ->has('employee')
            ->where('employee.join_date', '2023-05-15')
            ->where('employee.exit_date', null)
            ->where('employee.status', 'Active')
        );

        // Test updating the employee with an exit date
        $updateData = [
            'name' => 'Exit Date Test Employee',
            'email' => 'exit.test@example.com',
            'employee_id' => 'EMP-EXIT',
            'join_date' => '2023-05-15',
            'exit_date' => '2025-06-30',
            'status' => 'Inactive',
        ];

        $updateResponse = $this->actingAs($this->user)
            ->put(route('employee.update', $employee->id), $updateData);

        $updateResponse->assertRedirect(route('employee.index'));

        // Verify the database was updated with the exit date
        $updatedDetail = UserDetail::where('user_id', $employee->id)->first();
        $this->assertNotNull($updatedDetail);
        $this->assertEquals('2025-06-30', $updatedDetail->exit_date->format('Y-m-d'));
        $this->assertEquals('Inactive', $updatedDetail->status);

        // Verify the employee details page now shows the exit date
        $viewAfterUpdateResponse = $this->actingAs($this->user)
            ->get(route('employee.show', $employee->id));

        $viewAfterUpdateResponse->assertStatus(200);
        $viewAfterUpdateResponse->assertInertia(fn ($page) => $page
            ->component('employee/details')
            ->has('employee')
            ->where('employee.join_date', '2023-05-15')
            ->where('employee.exit_date', '2025-06-30')
            ->where('employee.status', 'Inactive')
        );
    }
}
