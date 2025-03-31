<?php

namespace Tests\Feature\Organization;

use App\Models\Branch;
use App\Models\Brand;
use App\Models\Company;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class BrandFilterTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    protected $company;

    protected $branch1;

    protected $branch2;

    protected $brand1;

    protected $brand2;

    protected $brand3;

    protected function setUp(): void
    {
        parent::setUp();

        // Create a user
        $this->user = User::factory()->create();

        // Create a company
        $this->company = Company::factory()->create([
            'name' => 'Test Company',
            'is_active' => true,
        ]);

        // Create two branches
        $this->branch1 = Branch::factory()->create([
            'name' => 'Branch One',
            'company_id' => $this->company->id,
            'is_active' => true,
        ]);

        $this->branch2 = Branch::factory()->create([
            'name' => 'Branch Two',
            'company_id' => $this->company->id,
            'is_active' => true,
        ]);

        // Create brands with different branches
        $this->brand1 = Brand::factory()->create([
            'name' => 'Brand One',
            'code' => 'BRD1',
            'company_id' => $this->company->id,
            'branch_id' => $this->branch1->id,
            'is_active' => true,
        ]);

        $this->brand2 = Brand::factory()->create([
            'name' => 'Brand Two',
            'code' => 'BRD2',
            'company_id' => $this->company->id,
            'branch_id' => $this->branch2->id,
            'is_active' => true,
        ]);

        $this->brand3 = Brand::factory()->create([
            'name' => 'Brand Three',
            'code' => 'BRD3',
            'company_id' => $this->company->id,
            'branch_id' => null,
            'is_active' => true,
        ]);
    }

    #[Test]
    public function it_can_filter_brands_by_search_term()
    {
        $response = $this->actingAs($this->user)
            ->get(route('organization.brand.index', ['search' => 'One']));

        $response->assertStatus(200);
        $response->assertInertia(fn ($page) => $page->component('organization/brand/index')
            ->has('brands.data', 1)
            ->where('brands.data.0.name', 'Brand One')
        );
    }

    #[Test]
    public function it_can_filter_brands_by_company()
    {
        $response = $this->actingAs($this->user)
            ->get(route('organization.brand.index', ['company_id' => $this->company->id]));

        $response->assertStatus(200);
        $response->assertInertia(fn ($page) => $page->component('organization/brand/index')
            ->has('brands.data', 3)
        );
    }

    #[Test]
    public function it_can_filter_brands_by_branch()
    {
        $response = $this->actingAs($this->user)
            ->get(route('organization.brand.index', ['branch_id' => $this->branch1->id]));

        $response->assertStatus(200);
        $response->assertInertia(fn ($page) => $page->component('organization/brand/index')
            ->has('brands.data', 1)
            ->where('brands.data.0.name', 'Brand One')
        );
    }

    #[Test]
    public function it_can_filter_brands_by_multiple_criteria()
    {
        $response = $this->actingAs($this->user)
            ->get(route('organization.brand.index', [
                'company_id' => $this->company->id,
                'branch_id' => $this->branch2->id,
            ]));

        $response->assertStatus(200);
        $response->assertInertia(fn ($page) => $page->component('organization/brand/index')
            ->has('brands.data', 1)
            ->where('brands.data.0.name', 'Brand Two')
        );
    }

    #[Test]
    public function it_returns_all_brands_when_no_filters_applied()
    {
        $response = $this->actingAs($this->user)
            ->get(route('organization.brand.index'));

        $response->assertStatus(200);
        $response->assertInertia(fn ($page) => $page->component('organization/brand/index')
            ->has('brands.data', 3)
        );
    }
}
