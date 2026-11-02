<?php

namespace Tests\Feature\Employee;

use App\Models\Branch;
use App\Models\Company;
use App\Models\Department;
use App\Models\Position;
use App\Models\Role;
use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Inertia\Testing\AssertableInertia as Assert;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class EmployeeFeatureTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected $user;

    protected $company;

    protected $branch;

    protected $department;

    protected $position;

    protected $adminRole;

    protected $employeeRole;

    protected $employee;

    protected $division;

    protected $subdivision;

    protected $level;

    protected function setUp(): void
    {
        parent::setUp();

        // Create a company
        $this->company = Company::factory()->create([
            'name' => 'Test Company',
            'is_active' => true,
        ]);

        // Create roles first with unique slugs
        $this->adminRole = Role::create([
            'company_id' => $this->company->id,
            'name' => 'administrator',
            'display_name' => 'Administrator',
            'description' => 'Full access to all system features',
            'is_system' => true,
            'slug' => 'administrator_'.uniqid(),
        ]);

        $this->employeeRole = Role::create([
            'company_id' => $this->company->id,
            'name' => 'employee',
            'display_name' => 'Employee',
            'description' => 'Regular employee access',
            'is_system' => true,
            'slug' => 'employee_'.uniqid(),
        ]);

        // Create a test user with admin role
        $this->user = User::factory()->forCompany($this->company->id)->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ]);

        // Assign admin role to test user
        $this->user->assignRole($this->adminRole);

        // Create user details
        $this->user->userDetails()->create([
            'company_id' => $this->company->id,
            'employee_code' => 'EMP'.$this->faker->unique()->numerify('######'),
            'status' => 'active',
            'join_date' => now(),
            'branch_id' => null,
            'department_id' => null,
            'position_id' => null,
        ]);

        // Create a branch
        $this->branch = Branch::factory()->create([
            'company_id' => $this->company->id,
            'name' => 'Main Branch',
            'is_main_branch' => true,
            'is_active' => true,
        ]);

        // Create a department
        $this->department = Department::factory()->create([
            'company_id' => $this->company->id,
            'branch_id' => $this->branch->id,
            'name' => 'HR Department',
            'is_active' => true,
        ]);

        // Create a position
        $this->position = Position::factory()->create([
            'company_id' => $this->company->id,
            'name' => 'HR Manager',
            'is_active' => true,
        ]);
    }

    // Employee Tests
    #[Test]
    public function user_can_view_employee_list()
    {
        $this->actingAs($this->user);

        // Create an employee
        $employee = User::factory()->forCompany($this->company->id)->create();

        // Update the row forCompany() already created; a second insert makes
        // hasOne resolve the wrong record.
        $employee->userDetails()->updateOrCreate(
            ['user_id' => $employee->id],
            [
            'company_id' => $this->company->id,
            'employee_code' => 'EMP'.$this->faker->unique()->numerify('######'),
            'status' => 'active',
            'join_date' => now(),
            'branch_id' => $this->branch->id,
            'department_id' => $this->department->id,
            'position_id' => $this->position->id,
            ]
        );

        // Assign employee role
        $employee->assignRole($this->employeeRole);

        // Clear the test user's employee role if it exists
        $this->user->roles()->detach($this->employeeRole);

        $response = $this->get(route('employee.index'));

        $response->assertInertia(function (Assert $page) {
            $page->component('employee/index')
                ->has('employees.data', 1)
                ->where('employees.current_page', 1)
                ->where('employees.per_page', 10)
                ->where('employees.total', 1)
                ->where('employees.from', 1)
                ->where('employees.to', 1)
                ->where('employees.last_page', 1);
        });
    }

    #[Test]
    public function employee_list_has_correct_structure()
    {
        // Create a test employee
        $employee = User::factory()->forCompany($this->company->id)->create();

        // Assign employee role
        // forCompany() already attaches the company's employee role, so a plain
        // attach() hits the unique(user_id, role_id, company_id) index.
        $employee->roles()->syncWithoutDetaching([
            $this->employeeRole->id => ['company_id' => $this->employeeRole->company_id],
        ]);

        // Update the row forCompany() already created; a second insert makes
        // hasOne resolve the wrong record.
        $employee->userDetails()->updateOrCreate(
            ['user_id' => $employee->id],
            [
            'company_id' => $this->company->id,
            'employee_code' => 'EMP'.$this->faker->unique()->numerify('######'),
            'status' => 'active',
            'join_date' => now(),
            'branch_id' => $this->branch->id,
            'department_id' => $this->department->id,
            'position_id' => $this->position->id,
            ]
        );
        $userDetail = $employee->userDetails()->first();

        // Make the request
        $response = $this->actingAs($this->user)
            ->get(route('employee.index'));

        // Assert the response
        $response->assertInertia(function (Assert $page) use ($employee, $userDetail) {
            $page->component('employee/index')
                ->has('employees.data', 1)
                ->where('employees.data.0.name', $employee->name)
                ->where('employees.data.0.email', $employee->email)
                ->where('employees.data.0.user_details.employee_code', $userDetail->employee_code)
                ->where('employees.data.0.user_details.position.name', $userDetail->position->name)
                ->where('employees.data.0.user_details.department.name', $userDetail->department->name)
                ->where('employees.data.0.user_details.status', $userDetail->status)
                ->where('employees.data.0.user_details.company.name', $userDetail->company->name);
        });
    }

    #[Test]
    public function employees_can_be_filtered_by_search()
    {
        $employee = User::factory()->forCompany($this->company->id)->create([
            'name' => 'John Doe',
        ]);

        // Update the row forCompany() already created; a second insert makes
        // hasOne resolve the wrong record.
        $employee->userDetails()->updateOrCreate(
            ['user_id' => $employee->id],
            [
            'company_id' => $this->company->id,
            'employee_code' => 'EMP'.$this->faker->unique()->numerify('######'),
            'status' => 'active',
            'join_date' => now(),
            'branch_id' => $this->branch->id,
            'department_id' => $this->department->id,
            'position_id' => $this->position->id,
            ]
        );

        // Assign employee role
        $employee->assignRole($this->employeeRole);

        // Clear the test user's employee role if it exists
        $this->user->roles()->detach($this->employeeRole);

        $this->actingAs($this->user);

        $response = $this->get(route('employee.index', [
            'search' => 'John',
        ]));

        $response->assertInertia(function (Assert $page) use ($employee) {
            $page->component('employee/index')
                ->has('employees.data', 1)
                ->where('employees.data.0.name', $employee->name)
                ->where('employees.current_page', 1)
                ->where('employees.per_page', 10)
                ->where('employees.total', 1)
                ->where('employees.from', 1)
                ->where('employees.to', 1)
                ->where('employees.last_page', 1);
        });
    }

    #[Test]
    public function employees_can_be_filtered_by_status()
    {
        $activeEmployee = User::factory()
            ->create();

        $inactiveEmployee = User::factory()
            ->create();

        $role = $this->employeeRole;
        $activeEmployee->assignRole($role);
        $inactiveEmployee->assignRole($role);

        $activeDetail = UserDetail::factory()->create([
            'user_id' => $activeEmployee->id,
            'company_id' => $this->company->id,
            'status' => 'active',
            'join_date' => now(),
            'branch_id' => $this->branch->id,
            'department_id' => $this->department->id,
            'position_id' => $this->position->id,
        ]);

        $inactiveDetail = UserDetail::factory()->create([
            'user_id' => $inactiveEmployee->id,
            'company_id' => $this->company->id,
            'status' => 'inactive',
            'join_date' => now(),
            'branch_id' => $this->branch->id,
            'department_id' => $this->department->id,
            'position_id' => $this->position->id,
        ]);

        $response = $this->actingAs($this->user)
            ->get(route('employee.index', ['status' => 'active']));

        $response->assertInertia(function (Assert $page) use ($activeEmployee) {
            $page->component('employee/index')
                ->has('employees.data', 1)
                ->where('employees.data.0.id', $activeEmployee->id);
        });
    }

    #[Test]
    public function employees_can_be_filtered_by_department()
    {
        // Create test employees in different departments
        $department1 = Department::factory()->create(['company_id' => $this->company->id]);
        $department2 = Department::factory()->create(['company_id' => $this->company->id]);

        // Build the detail rows directly: the factory's afterCreating hooks make
        // the relationship state hard to reason about, and these tests are about
        // the query, not about factory behaviour.
        $makeEmployee = function (int $departmentId) {
            $user = User::factory()->create();
            UserDetail::create([
                'user_id' => $user->id,
                'company_id' => $this->company->id,
                'department_id' => $departmentId,
                'status' => 'active',
            ]);
            $user->assignRole($this->employeeRole);

            return $user;
        };

        $makeEmployee($department1->id);
        $makeEmployee($department1->id);
        $makeEmployee($department2->id);

        $this->actingAs($this->user);

        $response = $this->get(route('employee.index', [
            'department_id' => $department1->id,
        ]));

        $response->assertInertia(function (Assert $page) use ($department1) {
            $page->component('employee/index')
                // Two employees belong to department1; the third belongs to
                // department2 and must be filtered out.
                ->has('employees.data', 2)
                ->where('employees.data.0.user_details.department_id', $department1->id)
                ->where('employees.data.1.user_details.department_id', $department1->id);
        });
    }

    #[Test]
    public function employees_can_be_filtered_by_position()
    {
        // Create test employees in different positions
        $position1 = Position::factory()->create(['company_id' => $this->company->id]);
        $position2 = Position::factory()->create(['company_id' => $this->company->id]);

        $makeEmployee = function (int $positionId) {
            $user = User::factory()->create();
            UserDetail::create([
                'user_id' => $user->id,
                'company_id' => $this->company->id,
                'position_id' => $positionId,
                'status' => 'active',
            ]);
            $user->assignRole($this->employeeRole);

            return $user;
        };

        $makeEmployee($position1->id);
        $makeEmployee($position1->id);
        $makeEmployee($position2->id);

        $this->actingAs($this->user);

        $response = $this->get(route('employee.index', [
            'position_id' => $position1->id,
        ]));

        $response->assertInertia(function (Assert $page) use ($position1) {
            $page->component('employee/index')
                ->has('employees.data', 2)
                ->where('employees.data.0.user_details.position_id', $position1->id)
                ->where('employees.data.1.user_details.position_id', $position1->id);
        });
    }

    #[Test]
    public function user_can_have_multiple_roles()
    {
        $user = User::factory()
            ->create();

        // Create multiple roles
        $role1 = Role::create([
            'company_id' => $this->company->id,
            'name' => 'role1',
            'display_name' => 'Role 1',
            'description' => 'First role',
            'is_system' => false,
            'slug' => 'role1',
        ]);

        $role2 = Role::create([
            'company_id' => $this->company->id,
            'name' => 'role2',
            'display_name' => 'Role 2',
            'description' => 'Second role',
            'is_system' => false,
            'slug' => 'role2',
        ]);

        // Assign both roles to the user
        $user->roles()->attach($role1->id, ['company_id' => $role1->company_id]);
        $user->roles()->attach($role2->id, ['company_id' => $role2->company_id]);

        // Verify the user has both roles
        $this->assertTrue($user->roles()->where('name', 'role1')->exists());
        $this->assertTrue($user->roles()->where('name', 'role2')->exists());

        // Verify the user has exactly 2 roles
        $this->assertCount(2, $user->roles);
    }

    // Employee Create Tests
    #[Test]
    public function user_can_view_employee_create_form()
    {
        $this->actingAs($this->user);

        $response = $this->get(route('employee.create'));
        $response->assertStatus(200);

        $response->assertInertia(function (Assert $page) {
            $page->component('employee/create')
                ->has('companies')
                ->has('departments')
                ->has('positions')
                ->has('branches');
        });
    }

    #[Test]
    public function user_can_create_employee_with_required_fields()
    {
        $this->actingAs($this->user);

        $response = $this->post(route('employee.store'), [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'password123',
            'employee_code' => 'EMP123456',
            'join_date' => now()->format('Y-m-d'),
            'status' => 'active',
            'branch_id' => $this->branch->id,
            'department_id' => $this->department->id,
            'position_id' => $this->position->id,
        ]);

        $response->assertRedirect(route('employee.index'));

        $this->assertDatabaseHas('users', [
            'email' => 'john@example.com',
            'name' => 'John Doe',
        ]);

        $this->assertDatabaseHas('user_details', [
            'employee_code' => 'EMP123456',
            'status' => 'active',
            'branch_id' => $this->branch->id,
            'department_id' => $this->department->id,
            'position_id' => $this->position->id,
        ]);
    }

    // Employee Update Tests
    #[Test]
    public function user_can_view_employee_edit_form()
    {
        $employee = User::factory()->forCompany($this->company->id)->create();
        $employee->assignRole($this->employeeRole);

        $this->actingAs($this->user);

        $response = $this->get(route('employee.edit', $employee));
        $response->assertStatus(200);

        $response->assertInertia(function (Assert $page) {
            $page->component('employee/edit')
                ->has('companies')
                ->has('departments')
                ->has('positions')
                ->has('branches');
        });
    }

    #[Test]
    public function user_can_update_employee_details()
    {
        $employee = User::factory()->forCompany($this->company->id)->create();
        $employee->assignRole($this->employeeRole);

        $this->actingAs($this->user);

        $response = $this->put(route('employee.update', $employee), [
            'name' => 'Updated Name',
            'email' => 'updated@example.com',
            'status' => 'on_leave',
            'branch_id' => $this->branch->id,
            'department_id' => $this->department->id,
            'position_id' => $this->position->id,
        ]);

        $response->assertRedirect(route('employee.show', $employee));

        $this->assertDatabaseHas('users', [
            'id' => $employee->id,
            'name' => 'Updated Name',
            'email' => 'updated@example.com',
        ]);

        $this->assertDatabaseHas('user_details', [
            'user_id' => $employee->id,
            'status' => 'on_leave',
            'branch_id' => $this->branch->id,
            'department_id' => $this->department->id,
            'position_id' => $this->position->id,
        ]);
    }

    // Employee Import Tests
    #[Test]
    public function user_can_view_employee_import_form()
    {
        $this->actingAs($this->user);

        $response = $this->get(route('employee.import'));

        $response->assertStatus(200);

        $response->assertInertia(function (Assert $page) {
            $page->component('employee/import')
                ->has('templateRoute')
                ->has('processRoute');
        });
    }

    #[Test]
    public function user_can_import_employees_from_excel()
    {
        // UploadedFile::fake()->create() produces an empty placeholder, which is
        // not a readable xlsx. Generate a real workbook instead.
        $path = storage_path('app/employee_import_test.xlsx');
        $writer = \Spatie\SimpleExcel\SimpleExcelWriter::create($path);
        $writer->addRow([
            'employee_code' => 'EMP900001',
            'name' => 'Imported Employee',
            'email' => 'imported.'.uniqid().'@example.com',
            'company_code' => $this->company->code,
            'status' => 'Active',
            'is_active' => 'Yes',
        ]);
        $writer->close();

        $file = new UploadedFile(
            $path,
            'employee_import_test.xlsx',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            null,
            true
        );

        $response = $this->actingAs($this->user)
            ->postJson(route('employee.import.process'), ['file' => $file]);

        $response->assertStatus(200)
            ->assertJsonPath('results.success', 1);
    }

    // Employee Delete Tests
    #[Test]
    public function user_can_delete_employee()
    {
        $employee = User::factory()
            ->create();

        $role = $this->employeeRole;
        $employee->assignRole($role);

        $userDetail = UserDetail::factory()->create([
            'user_id' => $employee->id,
            'company_id' => $this->company->id,
            'employee_code' => 'EMP'.$this->faker->unique()->numerify('######'),
            'status' => 'active',
            'join_date' => now(),
            'branch_id' => $this->branch->id,
            'department_id' => $this->department->id,
            'position_id' => $this->position->id,
        ]);

        $response = $this->actingAs($this->user)
            ->delete(route('employee.destroy', $employee->id));

        $response->assertRedirect(route('employee.index'));
        $this->assertDatabaseMissing('users', ['id' => $employee->id]);
    }
}
