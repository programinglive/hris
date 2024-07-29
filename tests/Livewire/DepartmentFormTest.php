<?php

namespace Tests\Livewire;

use App\Livewire\DepartmentForm;
use App\Models\Department;
use App\Models\User;
use Database\Seeders\BranchSeeder;
use Database\Seeders\CompanySeeder;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class DepartmentFormTest extends TestCase
{
    use RefreshDatabase;

    public $department;

    /**
     * Set up the test environment before each test case.
     *
     * This function creates a new instance of the Department model with the specified code and name.
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->seed([
            CompanySeeder::class,
            BranchSeeder::class,
            UserSeeder::class

        ]);
        $this->department = Department::factory([
            'code' => 'D001',
            'name' => 'Department A',
        ])->create();
    }

    /** @test */
    public function it_can_edit_department()
    {

        Livewire::test(DepartmentForm::class)
            ->call('edit', $this->department->code)
            ->assertSet('code', 'D001')
            ->assertSet('name', 'Department A');
    }

    /** @test */
    public function it_can_destroy_department()
    {
        Livewire::test(DepartmentForm::class)
            ->call('destroy', 'D001');

        $this->assertSoftDeleted('departments', ['code' => 'D001']);
    }

    /** @test */
    public function it_can_update_department()
    {
        $this->actingAs(User::first());
        Livewire::test(DepartmentForm::class)
            ->set('department', $this->department)
            ->set('code', 'D002')
            ->set('name', 'Department B')
            ->call('update');
        
        $this->department = Department::where('code','D002')->first();

        $this->assertEquals('D002', $this->department->code);
        $this->assertEquals('Department B', $this->department->name);
    }

    /** @test */
    public function it_can_get_department_data()
    {
        $this->actingAs(User::first());
        Livewire::test(DepartmentForm::class)
            ->set('code', 'D001')
            ->set('name', 'Department A')
            ->call('departmentData');

        $this->assertEquals('D001', $this->department->code);
        $this->assertEquals('Department A', $this->department->name);
    }

    /** @test */
    public function it_can_save_department()
    {
        $this->actingAs(User::first());
        Livewire::test(DepartmentForm::class)
            ->set('code', 'D001')
            ->set('name', 'Department A')
            ->call('save');

        $this->assertEquals('D001', $this->department->code);
        $this->assertEquals('Department A', $this->department->name);
    }

    /** @test */
    public function it_can_render_department_form()
    {
        Livewire::test(DepartmentForm::class)
            ->assertSee('Code')
            ->assertSee('Name');
    }
}