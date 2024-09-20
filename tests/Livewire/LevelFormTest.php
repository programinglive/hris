<?php

namespace Tests\Livewire;

use App\Livewire\LevelForm;
use App\Models\Level;
use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class LevelFormTest extends TestCase
{
    use RefreshDatabase;

    public $level;

    /**
     * Set up the test environment before each test case.
     *
     * This function is called before each test case is executed. It performs the following steps:
     * 1. Calls the parent's setUp method to initialize the test environment.
     * 2. Seeds the database with the CompanySeeder, BranchSeeder, UserSeeder, DepartmentSeeder, and DivisionSeeder classes.
     * 3. Creates a new Level instance with the following attributes:
     *    - company_id: 1
     *    - branch_id: 1
     *    - department_id: 1
     *    - division_id: 1
     *    - code: 'L001'
     *    - name: 'Level A'
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->seed(DatabaseSeeder::class);

        $this->level == Level::factory([
            'company_id' => 1,
            'branch_id' => 1,
            'department_id' => 1,
            'division_id' => 1,
            'code' => 'L001',
            'name' => 'Level A',
        ])->create();

    }

    /**
     * Test case for updating a level.
     *
     * This test case verifies that the 'update' method of the LevelForm component
     * can successfully update a level with the provided code and name.
     *
     * @return void
     */
    #[Test]
    public function it_can_update()
    {
        $this->actingAs(User::first());
        Livewire::test(LevelForm::class)
            ->call('edit', 'L001')
            ->set('code', 'L002')
            ->set('name', 'Level B')
            ->call('update')
            ->assertOk();
    }

    /**
     * Test case for destroying a level.
     *
     * This test case verifies that the 'destroy' method of the LevelForm component
     * can successfully soft delete a level with the provided code.
     *
     * @return void
     */
    #[Test]
    public function it_can_destroy()
    {
        Livewire::test(LevelForm::class)
            ->call('destroy', 'L001')
            ->assertOk();

        $this->assertSoftDeleted('levels', ['code' => 'L001-deleted']);
    }

    /**
     * Test case for saving a level.
     *
     * This test case verifies that the 'save' method of the LevelForm component
     * can successfully save a new level with the provided code and name.
     *
     * @return void
     */
    #[Test]
    public function it_can_save()
    {
        Livewire::test(LevelForm::class)
            ->set('code', 'L002')
            ->set('name', 'Level B')
            ->call('save')
            ->assertOk();
    }
}
