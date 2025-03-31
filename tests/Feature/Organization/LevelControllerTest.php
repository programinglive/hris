<?php

namespace Tests\Feature\Organization;

use App\Models\Company;
use App\Models\Level;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class LevelControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected User $user;

    protected Company $company;

    protected function setUp(): void
    {
        parent::setUp();

        // Create a company
        $this->company = Company::factory()->create();

        // Create a user (without company association for testing)
        $this->user = User::factory()->create();

        // Act as the user
        $this->actingAs($this->user);
    }

    #[Test]
    public function it_can_display_index_page()
    {
        // Create some levels
        Level::factory()->count(3)->create([
            'company_id' => $this->company->id,
        ]);

        $response = $this->get(route('organization.level.index'));

        $response->assertStatus(200);
        $response->assertInertia(fn ($assert) => $assert
            ->component('organization/level/index')
            ->has('levels.data', 3)
        );
    }

    #[Test]
    public function it_can_display_create_page()
    {
        $response = $this->get(route('organization.level.create'));

        $response->assertStatus(200);
        $response->assertInertia(fn ($assert) => $assert
            ->component('organization/level/create')
            ->has('companies')
        );
    }

    #[Test]
    public function it_can_store_new_level()
    {
        $levelData = [
            'name' => 'Test Level',
            'description' => 'Test Description',
            'level_order' => 1,
            'company_id' => $this->company->id,
            'status' => 'active',
        ];

        $response = $this->post(route('organization.level.store'), $levelData);

        $response->assertRedirect(route('organization.level.index'));
        $response->assertSessionHas('success', 'Level created successfully.');

        $this->assertDatabaseHas('levels', [
            'name' => 'Test Level',
            'description' => 'Test Description',
            'level_order' => 1,
            'company_id' => $this->company->id,
        ]);
    }

    #[Test]
    public function it_validates_level_data_on_store()
    {
        $response = $this->post(route('organization.level.store'), [
            // Missing required fields
        ]);

        $response->assertSessionHasErrors(['name', 'level_order', 'company_id', 'status']);
    }

    #[Test]
    public function it_can_display_show_page()
    {
        $level = Level::factory()->create([
            'company_id' => $this->company->id,
        ]);

        $response = $this->get(route('organization.level.show', $level));

        $response->assertStatus(200);
        $response->assertInertia(fn ($assert) => $assert
            ->component('organization/level/show')
            ->has('level')
        );
    }

    #[Test]
    public function it_can_display_edit_page()
    {
        $level = Level::factory()->create([
            'company_id' => $this->company->id,
        ]);

        $response = $this->get(route('organization.level.edit', $level));

        $response->assertStatus(200);
        $response->assertInertia(fn ($assert) => $assert
            ->component('organization/level/edit')
            ->has('level')
            ->has('companies')
        );
    }

    #[Test]
    public function it_can_update_level()
    {
        $level = Level::factory()->create([
            'company_id' => $this->company->id,
        ]);

        $updatedData = [
            'name' => 'Updated Level',
            'description' => 'Updated Description',
            'level_order' => 2,
            'company_id' => $this->company->id,
            'status' => 'inactive',
        ];

        $response = $this->put(route('organization.level.update', $level), $updatedData);

        $response->assertRedirect(route('organization.level.index'));
        $response->assertSessionHas('success', 'Level updated successfully.');

        $this->assertDatabaseHas('levels', [
            'id' => $level->id,
            'name' => 'Updated Level',
            'description' => 'Updated Description',
            'level_order' => 2,
            'status' => 'inactive',
        ]);
    }

    #[Test]
    public function it_validates_level_data_on_update()
    {
        $level = Level::factory()->create([
            'company_id' => $this->company->id,
        ]);

        $response = $this->put(route('organization.level.update', $level), [
            // Missing required fields
        ]);

        $response->assertSessionHasErrors(['name', 'level_order', 'company_id', 'status']);
    }

    #[Test]
    public function it_can_delete_level()
    {
        $level = Level::factory()->create([
            'company_id' => $this->company->id,
        ]);

        $response = $this->delete(route('organization.level.destroy', $level));

        $response->assertRedirect(route('organization.level.index'));
        $response->assertSessionHas('success', 'Level deleted successfully.');

        $this->assertSoftDeleted('levels', [
            'id' => $level->id,
        ]);
    }
}
