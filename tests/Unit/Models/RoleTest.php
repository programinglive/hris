<?php

namespace Tests\Unit\Models;

use App\Models\Company;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class RoleTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_can_create_a_role()
    {
        $company = Company::factory()->create();

        $role = Role::create([
            'name' => 'testrole',
            'description' => 'Test Role Description',
            'company_id' => $company->id,
        ]);

        $this->assertDatabaseHas('roles', [
            'name' => 'testrole',
            'description' => 'Test Role Description',
            'company_id' => $company->id,
            'slug' => 'testrole',
        ]);

        $this->assertEquals('testrole', $role->name);
        $this->assertEquals('Test Role Description', $role->description);
        $this->assertEquals($company->id, $role->company_id);
        $this->assertEquals('testrole', $role->slug);
    }

    #[Test]
    public function it_can_find_or_create_a_role()
    {
        $company = Company::factory()->create();

        // First creation
        $role1 = Role::updateOrCreate([
            'name' => 'admin',
            'company_id' => $company->id,
        ], [
            'description' => 'Administrator Role',
        ]);

        $this->assertDatabaseHas('roles', [
            'name' => 'admin',
            'description' => 'Administrator Role',
            'company_id' => $company->id,
            'slug' => 'admin',
        ]);

        // Second attempt - should find existing role
        $role2 = Role::updateOrCreate([
            'name' => 'admin',
            'company_id' => $company->id,
        ], [
            'description' => 'Administrator Role',
        ]);

        $this->assertEquals($role1->id, $role2->id);
        $this->assertEquals('Administrator Role', $role2->description);
        $this->assertEquals($company->id, $role2->company_id);
        $this->assertEquals('admin', $role2->slug);
    }

    #[Test]
    public function it_can_update_a_role()
    {
        $company = Company::factory()->create();

        $role = Role::create([
            'name' => 'testrole',
            'description' => 'Test Role Description',
            'company_id' => $company->id,
        ]);

        $role->update([
            'description' => 'Updated Description',
        ]);

        $this->assertDatabaseHas('roles', [
            'name' => 'testrole',
            'description' => 'Updated Description',
            'company_id' => $company->id,
            'slug' => 'testrole',
        ]);

        $this->assertEquals('Updated Description', $role->description);
    }

    #[Test]
    public function it_can_delete_a_role()
    {
        $company = Company::factory()->create();

        $role = Role::create([
            'name' => 'testrole',
            'description' => 'Test Role Description',
            'company_id' => $company->id,
        ]);

        $role->delete();

        $this->assertDatabaseMissing('roles', [
            'name' => 'testrole',
        ]);
    }

    #[Test]
    public function it_can_have_multiple_users()
    {
        $company = Company::factory()->create();

        $role = Role::create([
            'name' => 'testrole',
            'description' => 'Test Role Description',
            'company_id' => $company->id,
        ]);

        // Create two users with this role
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();

        // Create user roles
        \App\Models\UserRole::create([
            'user_id' => $user1->id,
            'role_id' => $role->id,
            'company_id' => $company->id,
        ]);

        \App\Models\UserRole::create([
            'user_id' => $user2->id,
            'role_id' => $role->id,
            'company_id' => $company->id,
        ]);

        $this->assertEquals(2, $role->users()->count());
    }
}
