<?php

namespace Tests\Feature\Organization;

use App\Models\Branch;
use App\Models\Company;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Inertia\Testing\AssertableInertia;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class BranchListTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();

        // Create a user and authenticate
        $this->user = User::factory()->create();
        $this->actingAs($this->user);
    }

    #[Test]
    public function it_can_display_branch_list_page()
    {
        // Create a company
        $company = Company::factory()->create();

        // Create some branches
        $branches = Branch::factory()->count(3)->create([
            'company_id' => $company->id,
        ]);

        // Access the branch list page
        $response = $this->get(route('organization.branch.index'));

        // Assert the response is successful
        $response->assertStatus(200);

        // Assert the correct Inertia page is rendered with paginated data
        $response->assertInertia(fn (AssertableInertia $page) => $page->component('organization/branch/index')
            ->has('branches.data', 3)
            ->has('branches.data.0', fn (AssertableInertia $branch) => $branch->has('id')
                ->has('name')
                ->has('code')
                ->has('address')
                ->has('city')
                ->has('company')
                ->has('is_active')
                ->has('is_main_branch')
                ->has('created_at')
            )
            ->has('branches.current_page')
            ->has('branches.per_page')
            ->has('branches.total')
            ->has('companies')
            ->has('cities')
        );
    }

    #[Test]
    public function it_has_correct_route_names()
    {
        // Test that all branch routes are correctly mapped
        $this->assertEquals(url('organization/branch'), route('organization.branch.index'));
        $this->assertEquals(url('organization/branch/create'), route('organization.branch.create'));
        $this->assertEquals(url('organization/branch/import/template'), route('organization.branch.import.template'));
        $this->assertEquals(url('organization/branch/import/process'), route('organization.branch.import.process'));
    }

    #[Test]
    public function it_can_filter_branches_by_search_query()
    {
        // Create a company
        $company = Company::factory()->create();

        // Create branches with different names
        Branch::factory()->create([
            'name' => 'Alpha Branch',
            'code' => 'ALPHA001',
            'company_id' => $company->id,
        ]);

        Branch::factory()->create([
            'name' => 'Beta Branch',
            'code' => 'BETA001',
            'company_id' => $company->id,
        ]);

        Branch::factory()->create([
            'name' => 'Gamma Branch',
            'code' => 'GAMMA001',
            'company_id' => $company->id,
        ]);

        // Test search by branch name
        $response = $this->get(route('organization.branch.index', ['search' => 'Alpha']));

        $response->assertStatus(200);
        $response->assertInertia(fn (AssertableInertia $page) => $page->component('organization/branch/index')
            ->has('branches.data', 1) // Only one result should match
            ->where('filters.search', 'Alpha')
        );

        // Test search by branch code
        $response = $this->get(route('organization.branch.index', ['search' => 'BETA']));

        $response->assertStatus(200);
        $response->assertInertia(fn (AssertableInertia $page) => $page->component('organization/branch/index')
            ->has('branches.data', 1)
            ->where('filters.search', 'BETA')
        );
    }

    #[Test]
    public function it_can_filter_branches_by_company()
    {
        // Create companies
        $company1 = Company::factory()->create(['name' => 'Company Alpha']);
        $company2 = Company::factory()->create(['name' => 'Company Beta']);

        // Create test branches
        Branch::factory()->create([
            'name' => 'Branch One',
            'company_id' => $company1->id,
        ]);

        Branch::factory()->create([
            'name' => 'Branch Two',
            'company_id' => $company2->id,
        ]);

        Branch::factory()->create([
            'name' => 'Branch Three',
            'company_id' => $company1->id,
        ]);

        // Test company filter
        $response = $this->get(route('organization.branch.index', ['company_id' => $company1->id]));

        $response->assertStatus(200);
        $response->assertInertia(fn (AssertableInertia $page) => $page->component('organization/branch/index')
            ->has('branches.data', 2) // Should have 2 branches from company1
            ->where('filters.company_id', (string) $company1->id)
        );
    }

    #[Test]
    public function it_can_filter_branches_by_location()
    {
        // Create a company
        $company = Company::factory()->create();

        // Create test branches with different cities
        Branch::factory()->create([
            'name' => 'Branch Jakarta',
            'city' => 'Jakarta',
            'company_id' => $company->id,
        ]);

        Branch::factory()->create([
            'name' => 'Branch Surabaya',
            'city' => 'Surabaya',
            'company_id' => $company->id,
        ]);

        Branch::factory()->create([
            'name' => 'Branch Jakarta 2',
            'city' => 'Jakarta',
            'company_id' => $company->id,
        ]);

        // Test city filter
        $response = $this->get(route('organization.branch.index', ['city' => 'Jakarta']));

        $response->assertStatus(200);
        $response->assertInertia(fn (AssertableInertia $page) => $page->component('organization/branch/index')
            ->has('branches.data', 2) // Should have 2 branches in Jakarta
            ->where('filters.city', 'Jakarta')
        );
    }

    #[Test]
    public function it_paginates_branches_correctly()
    {
        // Create a company
        $company = Company::factory()->create();

        // Create 15 test branches with unique codes (more than the per_page limit of 10)
        for ($i = 1; $i <= 15; $i++) {
            Branch::factory()->create([
                'company_id' => $company->id,
                'code' => 'TEST-'.str_pad($i, 3, '0', STR_PAD_LEFT), // Ensure unique codes
            ]);
        }

        // Test first page
        $response = $this->get(route('organization.branch.index'));

        $response->assertStatus(200);
        $response->assertInertia(fn (AssertableInertia $page) => $page->component('organization/branch/index')
            ->has('branches.data', 10) // Should have 10 branches on first page
            ->where('branches.current_page', 1)
            ->where('branches.per_page', 10)
            ->where('branches.total', 15)
        );

        // Test second page
        $response = $this->get(route('organization.branch.index', ['page' => 2]));

        $response->assertStatus(200);
        $response->assertInertia(fn (AssertableInertia $page) => $page->component('organization/branch/index')
            ->has('branches.data', 5) // Should have 5 branches on second page
            ->where('branches.current_page', 2)
        );
    }
}
