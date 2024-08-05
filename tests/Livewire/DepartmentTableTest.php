<?php

namespace Tests\Livewire;

use App\Livewire\DepartmentTable;
use App\Models\Department;
use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class DepartmentTableTest extends TestCase
{
    use RefreshDatabase;

    public $department;

    /**
     * Set up the test environment before each test case.
     *
     * This function seeds the database with the necessary data for testing.
     * It calls the parent setUp function and then runs the CompanySeeder,
     * BranchSeeder, and UserSeeder to populate the database with test data.
     * Finally, it assigns the first Department record to the $this->department property.
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->seed(DatabaseSeeder::class);

        $this->department = Department::first();

        $this->actingAs(User::first());
    }

    /**
     * Test the 'getDepartments' method of the DepartmentTable class.
     *
     * This test case sets the 'search' property of the Livewire component
     * to the code of the first department in the database. It then calls
     * the 'getDepartments' method of the component and asserts that the
     * department code is present in the rendered output.
     *
     * @return void
     */
    public function testGetDepartments()
    {
        Livewire::test(DepartmentTable::class)
            ->set('search', $this->department->code)
            ->call('getDepartments')
            ->assertSee($this->department->code);
    }
}