<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class AssetsRoutesTest extends TestCase
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
    public function test_assets_routes_are_accessible()
    {
        $this->actingAs($this->user);

        // Test Category route
        $response = $this->get(route('assets.category'));
        $response->assertStatus(200)->assertOk();

        // Test Sub Category route
        $response = $this->get(route('assets.sub-category'));
        $response->assertStatus(200)->assertOk();

        // Test Inventory route
        $response = $this->get(route('assets.inventory'));
        $response->assertSuccessful();

        // Test Assets Lists route
        $response = $this->get(route('assets.lists'));
        $response->assertSuccessful();

        // Test Request route
        $response = $this->get(route('assets.request'));
        $response->assertSuccessful();
    }

    #[Test]
    public function test_assets_route_names_are_correctly_mapped()
    {
        // Test that all assets route names are correctly mapped
        $this->assertEquals(url('assets/category'), route('assets.category'));
        $this->assertEquals(url('assets/sub-category'), route('assets.sub-category'));
        $this->assertEquals(url('assets/inventory'), route('assets.inventory'));
        $this->assertEquals(url('assets'), route('assets.lists'));
        $this->assertEquals(url('assets/request'), route('assets.request'));
    }
}
