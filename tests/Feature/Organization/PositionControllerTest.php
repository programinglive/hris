<?php

namespace Tests\Feature\Organization;

use App\Models\Company;
use App\Models\Division;
use App\Models\Level;
use App\Models\Position;
use App\Models\SubDivision;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class PositionControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected User $user;

    protected Company $company;

    protected Level $level;

    protected SubDivision $subDivision;

    protected Division $division;

    protected function setUp(): void
    {
        parent::setUp();

        // Create a company
        $this->company = Company::factory()->create();

        // Create a user (without company association for testing)
        $this->user = User::factory()->create();

        // Create a division
        $this->division = Division::factory()->create();

        // Create a level
        $this->level = Level::factory()->create([
            'company_id' => $this->company->id,
        ]);

        // Create a sub-division
        $this->subDivision = SubDivision::factory()->create([
            'division_id' => $this->division->id,
        ]);

        // Act as the user
        $this->actingAs($this->user);
    }

    #[Test]
    public function it_can_display_index_page()
    {
        // Create some positions
        Position::factory()->count(3)->create([
            'company_id' => $this->company->id,
            'level_id' => $this->level->id,
            'sub_division_id' => $this->subDivision->id,
        ]);

        $response = $this->get(route('organization.position.index'));

        $response->assertStatus(200);
        $response->assertInertia(fn ($assert) => $assert
            ->component('organization/position/index')
            ->has('positions.data', 3)
            ->has('levels')
            ->has('subDivisions')
        );
    }

    #[Test]
    public function it_can_display_create_page()
    {
        $response = $this->get(route('organization.position.create'));

        $response->assertStatus(200);
        $response->assertInertia(fn ($assert) => $assert
            ->component('organization/position/create')
            ->has('levels')
            ->has('subDivisions')
            ->has('companies')
        );
    }

    #[Test]
    public function it_can_store_new_position()
    {
        $positionData = [
            'name' => 'Test Position',
            'description' => 'Test Description',
            'level_id' => $this->level->id,
            'sub_division_id' => $this->subDivision->id,
            'company_id' => $this->company->id,
            'status' => 'active',
        ];

        $response = $this->post(route('organization.position.store'), $positionData);

        $response->assertRedirect(route('organization.position.index'));
        $response->assertSessionHas('success', 'Position created successfully.');

        $this->assertDatabaseHas('positions', [
            'name' => 'Test Position',
            'description' => 'Test Description',
            'level_id' => $this->level->id,
            'sub_division_id' => $this->subDivision->id,
            'company_id' => $this->company->id,
            'status' => 'active',
        ]);
    }

    #[Test]
    public function it_validates_position_data_on_store()
    {
        $response = $this->post(route('organization.position.store'), [
            // Missing required fields
        ]);

        $response->assertSessionHasErrors(['name', 'company_id', 'status']);
    }

    #[Test]
    public function it_can_display_show_page()
    {
        $position = Position::factory()->create([
            'company_id' => $this->company->id,
            'level_id' => $this->level->id,
            'sub_division_id' => $this->subDivision->id,
        ]);

        $response = $this->get(route('organization.position.show', $position));

        $response->assertStatus(200);
        $response->assertInertia(fn ($assert) => $assert
            ->component('organization/position/show')
            ->has('position')
        );
    }

    #[Test]
    public function it_can_display_edit_page()
    {
        $position = Position::factory()->create([
            'company_id' => $this->company->id,
            'level_id' => $this->level->id,
            'sub_division_id' => $this->subDivision->id,
        ]);

        $response = $this->get(route('organization.position.edit', $position));

        $response->assertStatus(200);
        $response->assertInertia(fn ($assert) => $assert
            ->component('organization/position/edit')
            ->has('position')
            ->has('levels')
            ->has('subDivisions')
            ->has('companies')
        );
    }

    #[Test]
    public function it_can_update_position()
    {
        $position = Position::factory()->create([
            'company_id' => $this->company->id,
            'level_id' => $this->level->id,
            'sub_division_id' => $this->subDivision->id,
        ]);

        $updatedData = [
            'name' => 'Updated Position',
            'description' => 'Updated Description',
            'level_id' => $this->level->id,
            'sub_division_id' => $this->subDivision->id,
            'company_id' => $this->company->id,
            'status' => 'inactive',
        ];

        $response = $this->put(route('organization.position.update', $position), $updatedData);

        $response->assertRedirect(route('organization.position.index'));
        $response->assertSessionHas('success', 'Position updated successfully.');

        $this->assertDatabaseHas('positions', [
            'id' => $position->id,
            'name' => 'Updated Position',
            'description' => 'Updated Description',
            'status' => 'inactive',
        ]);
    }

    #[Test]
    public function it_validates_position_data_on_update()
    {
        $position = Position::factory()->create([
            'company_id' => $this->company->id,
            'level_id' => $this->level->id,
            'sub_division_id' => $this->subDivision->id,
        ]);

        $response = $this->put(route('organization.position.update', $position), [
            // Missing required fields
        ]);

        $response->assertSessionHasErrors(['name', 'company_id', 'status']);
    }

    #[Test]
    public function it_can_delete_position()
    {
        $position = Position::factory()->create([
            'company_id' => $this->company->id,
            'level_id' => $this->level->id,
            'sub_division_id' => $this->subDivision->id,
        ]);

        $response = $this->delete(route('organization.position.destroy', $position));

        $response->assertRedirect(route('organization.position.index'));
        $response->assertSessionHas('success', 'Position deleted successfully.');

        $this->assertSoftDeleted('positions', [
            'id' => $position->id,
        ]);
    }

    #[Test]
    public function test_user_can_create_position(): void
    {
        $this->actingAs($this->user, 'web');

        $response = $this->post(route('organization.position.store'), [
            'name' => 'Test Position',
            'description' => 'Test position description',
            'company_id' => $this->company->id,
            'level_id' => $this->level->id,
            'sub_division_id' => $this->subDivision->id,
            'status' => 'active',
        ]);

        $response->assertRedirect(route('organization.position.index'));
        $this->assertDatabaseHas('positions', [
            'name' => 'Test Position',
            'company_id' => $this->company->id,
            'level_id' => $this->level->id,
            'sub_division_id' => $this->subDivision->id,
            'status' => 'active',
        ]);
    }

    #[Test]
    public function test_user_can_update_position(): void
    {
        $this->actingAs($this->user, 'web');

        $position = Position::factory()->create([
            'company_id' => $this->company->id,
            'level_id' => $this->level->id,
            'sub_division_id' => $this->subDivision->id,
            'status' => 'active',
        ]);

        $response = $this->put(route('organization.position.update', $position), [
            'name' => 'Updated Position',
            'description' => 'Updated position description',
            'company_id' => $this->company->id,
            'level_id' => $this->level->id,
            'sub_division_id' => $this->subDivision->id,
            'status' => 'inactive',
        ]);

        $response->assertRedirect(route('organization.position.index'));
        $this->assertDatabaseHas('positions', [
            'id' => $position->id,
            'name' => 'Updated Position',
            'company_id' => $this->company->id,
            'level_id' => $this->level->id,
            'sub_division_id' => $this->subDivision->id,
            'status' => 'inactive',
        ]);
    }

    #[Test]
    public function test_user_can_delete_position(): void
    {
        $this->actingAs($this->user, 'web');

        $position = Position::factory()->create([
            'company_id' => $this->company->id,
            'level_id' => $this->level->id,
            'sub_division_id' => $this->subDivision->id,
            'status' => 'active',
        ]);

        $response = $this->delete(route('organization.position.destroy', $position));

        $response->assertRedirect(route('organization.position.index'));
        $this->assertSoftDeleted('positions', [
            'id' => $position->id,
        ]);
    }
}
