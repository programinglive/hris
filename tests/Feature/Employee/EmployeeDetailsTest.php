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

class EmployeeDetailsTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected $user;
    protected $company;
    protected $branch;
    protected $department;
    protected $position;
    protected $adminRole;
    protected $employee;
    protected $division;
    protected $subdivision;
    protected $level;

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
        
        // Create department
        $this->department = Department::create([
            'company_id' => $this->company->id,
            'name' => 'IT Department',
            'description' => 'Information Technology',
            'status' => 'active',
        ]);
        
        // Create a division
        $this->division = Division::create([
            'name' => 'IT Division',
            'code' => 'ITD',
            'description' => 'IT Division',
            'department_id' => $this->department->id,
            'company_id' => $this->company->id,
            'status' => 'active',
        ]);
        
        // Create a subdivision
        $this->subdivision = SubDivision::create([
            'name' => 'Development',
            'code' => 'DEV',
            'description' => 'Development Team',
            'division_id' => $this->division->id,
            'status' => 'active',
        ]);
        
        // Create a level
        $this->level = Level::create([
            'name' => 'Junior',
            'code' => 'JR',
            'description' => 'Junior Level',
            'level_order' => 1,
            'company_id' => $this->company->id,
            'status' => 'active',
        ]);
        
        // Create position
        $this->position = Position::create([
            'company_id' => $this->company->id,
            'name' => 'Software Developer',
            'code' => 'SOF-001',
            'description' => 'Develops software applications',
            'level_id' => $this->level->id,
            'sub_division_id' => $this->subdivision->id,
            'status' => 'active',
        ]);
        
        // Create and assign admin role
        $this->adminRole = Role::create([
            'name' => 'administrator',
            'display_name' => 'Administrator',
            'description' => 'Full access to all system features',
        ]);
        
        // Create admin user
        $this->user = User::factory()->create([
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
        ]);
        
        // Assign role to admin user
        $this->user->roles()->attach($this->adminRole->id);
        
        // Create admin user detail
        UserDetail::create([
            'user_id' => $this->user->id,
            'employee_id' => 'EMP001',
            'company_id' => $this->company->id,
            'branch_id' => $this->branch->id,
            'status' => 'Active',
        ]);
        
        // Create an employee for testing
        $this->employee = User::factory()->create([
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
        ]);
        
        // Assign role to employee
        $this->employee->roles()->attach($this->adminRole->id);
        
        // Create employee details with all fields
        UserDetail::create([
            'user_id' => $this->employee->id,
            'employee_id' => 'EMP002',
            'company_id' => $this->company->id,
            'branch_id' => $this->branch->id,
            'department_id' => $this->department->id,
            'position_id' => $this->position->id,
            'join_date' => now()->subYear(),
            'status' => 'Active',
            'gender' => 'Male',
            'birth_date' => now()->subYears(30),
            'marital_status' => 'Single',
            'phone' => '1234567890',
            'address' => '123 Test Street, Test City',
            'emergency_contact_name' => 'Jane Doe',
            'emergency_contact_relationship' => 'Spouse',
            'emergency_contact_phone' => '0987654321',
        ]);
    }

    #[Test]
    public function admin_can_view_employee_details()
    {
        $response = $this->actingAs($this->user)
            ->get(route('employee.show', $this->employee->id));

        $response->assertStatus(200);
        $response->assertInertia(fn ($page) => $page
            ->component('employee/details')
            ->has('employee')
            ->where('employee.id', $this->employee->id)
            ->where('employee.name', 'John Doe')
            ->where('employee.email', 'john.doe@example.com')
            ->where('employee.employee_id', 'EMP002')
            ->where('employee.department', 'IT Department')
            ->where('employee.position', 'Software Developer')
        );
    }

    #[Test]
    public function employee_details_has_correct_structure()
    {
        $response = $this->actingAs($this->user)
            ->get(route('employee.show', $this->employee->id));

        $response->assertStatus(200);
        $response->assertInertia(fn ($page) => $page
            ->component('employee/details')
            ->has('employee', fn ($employee) => $employee
                ->has('id')
                ->has('name')
                ->has('email')
                ->has('employee_id')
                ->has('phone')
                ->has('address')
                ->has('position')
                ->has('department')
                ->has('division')
                ->has('sub_division')
                ->has('level')
                ->has('company')
                ->has('branch')
                ->has('join_date')
                ->has('exit_date')
                ->has('status')
                ->has('gender')
                ->has('birth_date')
                ->has('marital_status')
                ->has('profile_image')
                ->has('emergency_contact', fn ($contact) => $contact
                    ->has('name')
                    ->has('relationship')
                    ->has('phone')
                )
            )
        );
    }

    #[Test]
    public function employee_details_returns_404_for_nonexistent_employee()
    {
        $response = $this->actingAs($this->user)
            ->get(route('employee.show', 9999));

        $response->assertStatus(404);
    }
}
