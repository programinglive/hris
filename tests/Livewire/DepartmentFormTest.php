<?php

namespace Tests\Livewire;

use App\Http\Controllers\DepartmentController;
use App\Livewire\DepartmentForm;
use App\Models\Department;
use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use PHPUnit\Framework\AssertionFailedError;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class DepartmentFormTest extends TestCase
{
    use RefreshDatabase;

    public $department;

    /**
     * Set up the test environment before each test case.
     *
     * This function creates a new instance of the Department model with the specified code and name.
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->seed(DatabaseSeeder::class);

        $this->department = Department::factory([
            'code' => 'D001',
            'name' => 'Department A',
        ])->create();

        $this->actingAs(User::first());
    }

    /**
     * Test that the 'edit' method of the DepartmentForm component can successfully update the 'code' and 'name' fields.
     *
     * @throws AssertionFailedError if the assertions fail
     */
    #[Test]
    public function testItCanEditDepartment(): void
    {
        Livewire::test(DepartmentForm::class)
            ->call('edit', $this->department->code)
            ->assertSet('code', 'D001')
            ->assertSet('name', 'Department A');
    }

    /**
     * Test case for destroying a department.
     *
     * This test case verifies that the 'destroy' method of the DepartmentForm component
     * can successfully softly delete a department with the provided code.
     */
    #[Test]
    public function it_can_destroy_department(): void
    {
        Livewire::test(DepartmentForm::class)
            ->call('destroy', 'D001');

        $this->assertSoftDeleted('departments', ['code' => 'D001-deleted']);
    }

    /**
     * Test case for updating a department.
     *
     * This test case verifies that the 'update' method of the DepartmentForm component
     * can successfully update a department with the provided data.
     */
    #[Test]
    public function it_can_update_department(): void
    {
        $this->actingAs(User::first());
        $departmentCode = DepartmentController::generateCode();

        Livewire::test(DepartmentForm::class)
            ->set('companyId', $this->department->company_id)
            ->set('department', $this->department)
            ->set('code', $departmentCode)
            ->set('name', 'Department B')
            ->call('update');

        $this->department = Department::find($this->department->id);

        $this->assertEquals($departmentCode, $this->department->code);
        $this->assertEquals('Department B', $this->department->name);
    }

    /**
     * Test case for getting department data.
     *
     * This test case verifies that the 'departmentData' method of the DepartmentForm component
     * can successfully set the 'code' and 'name' fields.
     */
    #[Test]
    public function test_it_can_get_department_data(): void
    {
        $this->actingAs(User::first());
        Livewire::test(DepartmentForm::class)
            ->set('code', 'D001')
            ->set('name', 'Department A')
            ->call('departmentData');

        $this->assertEquals('D001', $this->department->code);
        $this->assertEquals('Department A', $this->department->name);
    }

    /**
     * Test case for saving a department.
     *
     * This test case verifies that the 'save' method of the DepartmentForm component
     * can successfully save a department with the provided data.
     *
     * @throws AssertionFailedError if the assertions fail
     */
    #[Test]
    public function it_can_save_department(): void
    {
        $this->actingAs(User::first());
        Livewire::test(DepartmentForm::class)
            ->set('code', 'D001')
            ->set('name', 'Department A')
            ->call('save');

        $this->assertEquals('D001', $this->department->code);
        $this->assertEquals('Department A', $this->department->name);
    }

    /**
     * Test case for rendering the department form.
     *
     * This test case verifies that the DepartmentForm component can successfully render the form
     * with the expected fields (code and name).
     */
    #[Test]
    public function it_can_render_department_form(): void
    {
        Livewire::test(DepartmentForm::class)
            ->assertSee('Code')
            ->assertSee('Name');
    }
}
