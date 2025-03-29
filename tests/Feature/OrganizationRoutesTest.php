<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class OrganizationRoutesTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();
        
        // Create a user for testing
        $this->user = User::factory()->create();
    }

    #[Test]
    public function test_organization_routes_are_accessible()
    {
        $this->actingAs($this->user);

        // Test Company routes
        $response = $this->get(route('organization.company.index'));
        $response->assertStatus(200)->assertOk();
        
        $response = $this->get(route('organization.company.create'));
        $response->assertStatus(200)->assertOk();
        
        // Test Branch route
        $response = $this->get(route('organization.branch.index'));
        $response->assertSuccessful();
        
        // Test Brand route
        $response = $this->get(route('organization.brand.index'));
        $response->assertSuccessful();
        
        // Test Department route
        $response = $this->get(route('organization.department.index'));
        $response->assertSuccessful();
        
        // Skip Division and Subdivision routes as controllers are not implemented yet
        
        // Test Level route
        $response = $this->get(route('organization.level.index'));
        $response->assertSuccessful();
        
        // Test Position route
        $response = $this->get(route('organization.position.index'));
        $response->assertSuccessful();
    }

    #[Test]
    public function test_organization_route_names_are_correctly_mapped()
    {
        // Test that all organization route names are correctly mapped
        $this->assertEquals(url('organization/company'), route('organization.company.index'));
        $this->assertEquals(url('organization/company/create'), route('organization.company.create'));
        $this->assertEquals(url('organization/branch'), route('organization.branch.index'));
        $this->assertEquals(url('organization/brand'), route('organization.brand.index'));
        $this->assertEquals(url('organization/department'), route('organization.department.index'));
        $this->assertEquals(url('organization/level'), route('organization.level.index'));
        $this->assertEquals(url('organization/position'), route('organization.position.index'));
    }
}
