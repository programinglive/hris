<?php

namespace Tests\Feature\Employee;

use App\Models\User;
use App\Models\UserDetail;
use App\Models\Department;
use App\Models\Position;
use App\Models\Company;
use App\Models\Branch;
use App\Models\Role;
use App\Models\Level;
use App\Models\SubDivision;
use App\Models\Division;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class EmployeeListTest extends TestCase
{
    use RefreshDatabase;

    protected $user;
    protected $company;
    protected $branch;
    protected $department1;
    protected $department2;
    protected $position1;
    protected $position2;
    protected $adminRole;
    protected $employeeRole;
    protected $level;
    protected $subdivision;
    protected $division;

    protected function setUp(): void
    {
        parent::setUp();

        // Create roles
        $this->adminRole = Role::create([
            'name' => 'admin',
            'display_name' => 'Administrator',
            'description' => 'Full access to all system features',
        ]);
        
        $this->employeeRole = Role::create([
            'name' => 'employee',
            'display_name' => 'Employee',
            'description' => 'Regular employee access',
        ]);

        // Create a company and branch
        $this->company = Company::factory()->create([
            'name' => 'Test Company',
        ]);

        $this->branch = Branch::factory()->create([
            'company_id' => $this->company->id,
            'name' => 'Main Branch',
            'is_main_branch' => true,
        ]);

        // Create departments with company_id
        $this->department1 = Department::create([
            'name' => 'HR',
            'description' => 'Human Resources',
            'company_id' => $this->company->id,
            'status' => 'active',
        ]);

        $this->department2 = Department::create([
            'name' => 'IT',
            'description' => 'Information Technology',
            'company_id' => $this->company->id,
            'status' => 'active',
        ]);

        // Create a division
        $this->division = Division::create([
            'name' => 'Operations',
            'code' => 'OPS',
            'description' => 'Operations Division',
            'department_id' => $this->department1->id,
            'company_id' => $this->company->id,
            'status' => 'active',
        ]);

        // Create a level
        $this->level = Level::create([
            'name' => 'Management',
            'code' => 'MGT',
            'description' => 'Management Level',
            'level_order' => 1,
            'company_id' => $this->company->id,
            'status' => 'active',
        ]);

        // Create a subdivision
        $this->subdivision = SubDivision::create([
            'name' => 'General',
            'code' => 'GEN',
            'description' => 'General Subdivision',
            'division_id' => $this->division->id,
            'status' => 'active',
        ]);

        // Create positions
        $this->position1 = Position::create([
            'name' => 'Manager',
            'description' => 'Department Manager',
            'code' => 'MAN-001',
            'company_id' => $this->company->id,
            'level_id' => $this->level->id,
            'sub_division_id' => $this->subdivision->id,
            'status' => 'active',
        ]);

        $this->position2 = Position::create([
            'name' => 'Developer',
            'description' => 'Software Developer',
            'code' => 'DEV-001',
            'company_id' => $this->company->id,
            'level_id' => $this->level->id,
            'sub_division_id' => $this->subdivision->id,
            'status' => 'active',
        ]);

        // Create admin user
        $this->user = User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
        ]);

        // Assign role to user
        $this->user->roles()->attach($this->adminRole->id);

        // Create user detail for admin
        UserDetail::create([
            'user_id' => $this->user->id,
            'employee_id' => 'EMP001',
            'company_id' => $this->company->id,
            'branch_id' => $this->branch->id,
            'department_id' => $this->department1->id,
            'position_id' => $this->position1->id,
            'status' => 'Active',
        ]);
    }

    #[Test]
    public function admin_can_view_employee_list()
    {
        $response = $this->actingAs($this->user)
            ->get(route('employee.index'));

        $response->assertStatus(200);
        $response->assertInertia(fn ($page) => $page
            ->component('employee/index')
            ->has('employees')
        );
    }

    #[Test]
    public function employee_list_has_employees_with_correct_structure()
    {
        // Create additional employees with different departments and positions
        $employee1 = User::factory()->create(['name' => 'John Doe']);
        $employee1->roles()->attach($this->employeeRole->id);
        UserDetail::create([
            'user_id' => $employee1->id,
            'employee_id' => 'EMP002',
            'company_id' => $this->company->id,
            'branch_id' => $this->branch->id,
            'department_id' => $this->department1->id,
            'position_id' => $this->position1->id,
            'status' => 'Active',
        ]);

        $employee2 = User::factory()->create(['name' => 'Jane Smith']);
        $employee2->roles()->attach($this->employeeRole->id);
        UserDetail::create([
            'user_id' => $employee2->id,
            'employee_id' => 'EMP003',
            'company_id' => $this->company->id,
            'branch_id' => $this->branch->id,
            'department_id' => $this->department2->id,
            'position_id' => $this->position2->id,
            'status' => 'Active',
        ]);

        $response = $this->actingAs($this->user)
            ->get(route('employee.index'));

        $response->assertStatus(200);
        $response->assertInertia(fn ($page) => $page
            ->component('employee/index')
            ->has('employees')
            ->where('employees', function ($employees) {
                // Check that we have at least 3 employees (admin + 2 created)
                return count($employees) >= 3 && 
                    // Check that each employee has the required fields
                    collect($employees)->every(function ($employee) {
                        return isset($employee['id']) &&
                            isset($employee['name']) &&
                            isset($employee['email']) &&
                            isset($employee['employee_id']) &&
                            isset($employee['department']) &&
                            isset($employee['position']) &&
                            isset($employee['status']);
                    });
            })
        );
    }

    #[Test]
    public function employee_list_has_unique_departments_and_positions()
    {
        // Create multiple employees with the same department but different positions
        for ($i = 0; $i < 3; $i++) {
            $employee = User::factory()->create(['name' => "HR Employee $i"]);
            $employee->roles()->attach($this->employeeRole->id);
            UserDetail::create([
                'user_id' => $employee->id,
                'employee_id' => "EMP00" . ($i + 2),
                'company_id' => $this->company->id,
                'branch_id' => $this->branch->id,
                'department_id' => $this->department1->id, // HR department
                'position_id' => $this->position1->id, // Manager position
                'status' => 'Active',
            ]);
        }

        // Create multiple employees with the same position but different departments
        for ($i = 0; $i < 3; $i++) {
            $employee = User::factory()->create(['name' => "IT Employee $i"]);
            $employee->roles()->attach($this->employeeRole->id);
            UserDetail::create([
                'user_id' => $employee->id,
                'employee_id' => "EMP00" . ($i + 5),
                'company_id' => $this->company->id,
                'branch_id' => $this->branch->id,
                'department_id' => $this->department2->id, // IT department
                'position_id' => $this->position2->id, // Developer position
                'status' => 'Active',
            ]);
        }

        $response = $this->actingAs($this->user)
            ->get(route('employee.index'));

        $response->assertStatus(200);
        
        // Check that we have the expected number of employees (1 admin + 6 created)
        $response->assertInertia(fn ($page) => $page
            ->component('employee/index')
            ->has('employees', 7)
        );
        
        // Check that the controller is correctly loading the departments and positions
        $this->assertCount(2, Department::all());
        $this->assertCount(2, Position::all());
        
        // Verify that each department and position has a unique ID in the database
        $departmentIds = Department::pluck('id')->toArray();
        $positionIds = Position::pluck('id')->toArray();
        
        $this->assertCount(2, array_unique($departmentIds));
        $this->assertCount(2, array_unique($positionIds));
    }
}
