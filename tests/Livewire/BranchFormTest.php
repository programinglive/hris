<?php

namespace Tests\Livewire;

use App\Livewire\BranchForm;
use App\Models\Branch;
use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Faker\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use PHPUnit\Framework\AssertionFailedError;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class BranchFormTest extends TestCase
{
    use RefreshDatabase;

    public $branch;
    public $faker;

    /**
     * Set up the test environment before each test case.
     *
     * This function creates a new instance of the Branch model with the specified code and name.
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->seed(DatabaseSeeder::class);

        $this->faker = Factory::create();

        $this->branch = Branch::factory([
            'code' => 'D001',
            'name' => 'Branch A',
            'type' => 'branch'
        ])->create();

        auth()->login(User::first());
    }

    /**
     * Test that the 'edit' method of the BranchForm component can successfully update the 'code' and 'name' fields.
     *
     * @return void
     * @throws AssertionFailedError if the assertions fail
     */
    #[Test]
    public function testItCanEditBranch(): void
    {
        Livewire::test(BranchForm::class)
            ->call('edit', $this->branch->code)
            ->assertSet('code', 'D001')
            ->assertSet('name', 'Branch A')
            ->assertSet('type', 'branch');
    }

    /**
     * Test case for destroying a branch.
     *
     * This test case verifies that the 'destroy' method of the BranchForm component
     * can successfully softly delete a branch with the provided code.
     *
     * @return void
     */
    #[Test]
    public function it_can_destroy_branch(): void
    {
        Livewire::test(BranchForm::class)
            ->call('destroy', 'D001');

        $this->assertSoftDeleted('branches', ['code' => 'D001-deleted']);
    }

    /**
     * Test case for updating a branch.
     *
     * This test case verifies that the 'update' method of the BranchForm component
     * can successfully update a branch with the provided data.
     *
     */
    #[Test]
    public function it_can_update_branch(): void
    {
        $this->actingAs(User::first());
        Livewire::test(BranchForm::class)
            ->set('branch', $this->branch)
            ->set('code', 'D002')
            ->set('name', 'Branch B')
            ->set('type', 'partner')
            ->call('update');

        $this->branch = Branch::where('code','D002')->first();

        $this->assertEquals('D002', $this->branch->code);
        $this->assertEquals('Branch B', $this->branch->name);
        $this->assertEquals('partner', $this->branch->type);
    }

    /**
     * Test case for getting branch data.
     *
     * This test case verifies that the 'branchData' method of the BranchForm component
     * can successfully set the 'code' and 'name' fields.
     *
     */
    #[Test]
    public function test_it_can_get_branch_data(): void
    {
        $this->actingAs(User::first());
        Livewire::test(BranchForm::class)
            ->set('code', 'D001')
            ->set('name', 'Branch A')
            ->call('branchData');

        $this->assertEquals('D001', $this->branch->code);
        $this->assertEquals('Branch A', $this->branch->name);
    }

    /**
     * Test case for saving a branch.
     *
     * This test case verifies that the 'save' method of the BranchForm component
     * can successfully save a branch with the provided data.
     *
     * @return void
     * @throws AssertionFailedError if the assertions fail
     */
    #[Test]
    public function it_can_save_branch(): void
    {
        $this->actingAs(User::first());
        Livewire::test(BranchForm::class)
            ->set('code', 'D001')
            ->set('name', 'Branch A')
            ->set('type', 'branch')
            ->call('save');

        $this->assertEquals('D001', $this->branch->code);
        $this->assertEquals('Branch A', $this->branch->name);
    }

    /**
     * Test case for rendering the branch form.
     *
     * This test case verifies that the BranchForm component can successfully render the form
     * with the expected fields (code and name).
     *
     * @return void
     */
    #[Test]
    public function it_can_render_branch_form(): void
    {
        Livewire::test(BranchForm::class)
            ->assertSee('Code')
            ->assertSee('Name');
    }
}