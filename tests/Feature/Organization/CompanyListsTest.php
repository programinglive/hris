<?php

namespace Tests\Feature\Organization;

use App\Models\Company;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;
use Inertia\Testing\AssertableInertia as Assert;

class CompanyListsTest extends TestCase
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
    public function admin_can_view_company_lists()
    {
        // Create some test companies
        $companies = Company::factory()->count(3)->create();
        
        $this->actingAs($this->user);
        
        $response = $this->get(route('organization.company.index'));
        
        $response->assertStatus(200);
        $response->assertInertia(fn (Assert $page) => $page
            ->component('organization/company/index')
            ->has('companies.data', 3)
        );
    }

    #[Test]
    public function company_lists_has_correct_structure()
    {
        // Create a test company
        $company = Company::factory()->create([
            'name' => 'Test Company',
            'email' => 'test@example.com',
            'phone' => '1234567890',
            'city' => 'Test City',
            'country' => 'Test Country',
            'is_active' => true
        ]);
        
        $this->actingAs($this->user);
        
        $response = $this->get(route('organization.company.index'));
        
        $response->assertStatus(200);
        $response->assertInertia(fn (Assert $page) => $page
            ->component('organization/company/index')
            ->has('companies.data', 1)
            ->where('companies.data.0.id', $company->id)
            ->where('companies.data.0.name', 'Test Company')
            ->where('companies.data.0.email', 'test@example.com')
            ->where('companies.data.0.phone', '1234567890')
            ->where('companies.data.0.city', 'Test City')
            ->where('companies.data.0.country', 'Test Country')
            ->where('companies.data.0.is_active', true) 
        );
    }

    #[Test]
    public function companies_can_be_filtered_by_search()
    {
        // Create test companies
        Company::factory()->create(['name' => 'ABC Company']);
        Company::factory()->create(['name' => 'XYZ Corporation']);
        Company::factory()->create(['name' => 'DEF Industries']);
        
        $this->actingAs($this->user);
        
        // Test client-side filtering
        $response = $this->get(route('organization.company.index'));
        
        $response->assertStatus(200);
        $response->assertInertia(fn (Assert $page) => $page
            ->component('organization/company/index')
            ->has('companies.data', 3)
        );
    }

    #[Test]
    public function company_can_be_deleted()
    {
        // Create a test company
        $company = Company::factory()->create();
        
        $this->actingAs($this->user);
        
        // Delete the company
        $response = $this->delete(route('organization.company.destroy', $company->id));
        
        // Check if the company was deleted
        $this->assertDatabaseMissing('companies', ['id' => $company->id]);
        
        // Check if redirected to company index
        $response->assertRedirect(route('organization.company.index'));
    }
}
