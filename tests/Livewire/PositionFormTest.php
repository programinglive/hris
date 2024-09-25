<?php

namespace Tests\Livewire;

use App\Livewire\PositionForm;
use App\Models\Position;
use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class PositionFormTest extends TestCase
{
    use RefreshDatabase;

    public $position;

    /**
     * Set up the test environment before each test case.
     *
     * This function is called before each test case is executed. It sets up the necessary
     * dependencies and initializes any required data for the test cases. In this specific
     * implementation, it seeds the database with test data using the `DatabaseSeeder` class,
     * logs in the user using the `auth()->login()` method, and creates a new `Position` model
     * using the `Position::factory()->create()` method.
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->seed(DatabaseSeeder::class);

        auth()->login(User::first());

        $this->position = Position::factory()->create();
    }

    /**
     * Test the destroy functionality of the PositionForm component.
     *
     * This function tests the destroy functionality of the PositionForm component by calling the 'destroy' method
     * with the code of the position. It then asserts that the 'positions' table has been soft deleted with the
     * correct code.
     *
     * @return void
     */
    public function testDestroy()
    {
        Livewire::test(PositionForm::class)
            ->call('destroy', $this->position->code);

        $this->assertSoftDeleted('positions', [
            'code' => $this->position->code.'-deleted',
        ]);
    }
}
