<?php

namespace Tests\Feature\Employee;

use App\Models\Brand;
use App\Models\Company;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class BrandAssociationTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    protected $company;

    protected $brand1;

    protected $brand2;

    protected function setUp(): void
    {
        parent::setUp();

        // Create a company
        $this->company = Company::factory()->create();

        // Create test brands
        $this->brand1 = Brand::factory()->create([
            'company_id' => $this->company->id,
            'name' => 'Brand 1',
        ]);

        $this->brand2 = Brand::factory()->create([
            'company_id' => $this->company->id,
            'name' => 'Brand 2',
        ]);

        // Create test user
        $this->user = User::factory()->create([
            'company_id' => $this->company->id,
        ]);
    }

    #[Test]
    public function employee_can_be_associated_with_multiple_brands(): void
    {
        $brand1 = Brand::factory()->create(['company_id' => $this->company->id]);
        $brand2 = Brand::factory()->create(['company_id' => $this->company->id]);

        $this->user->brands()->attach([
            $brand1->id => [
                'role' => 'employee',
                'is_primary' => false,
                'company_id' => $this->company->id,
            ],
            $brand2->id => [
                'role' => 'employee',
                'is_primary' => false,
                'company_id' => $this->company->id,
            ],
        ]);

        $this->assertDatabaseHas('user_brands', [
            'user_id' => $this->user->id,
            'brand_id' => $brand1->id,
            'role' => 'employee',
            'is_primary' => false,
            'company_id' => $this->company->id,
        ]);

        $this->assertDatabaseHas('user_brands', [
            'user_id' => $this->user->id,
            'brand_id' => $brand2->id,
            'role' => 'employee',
            'is_primary' => false,
            'company_id' => $this->company->id,
        ]);

        $this->assertCount(2, $this->user->brands);
    }

    #[Test]
    public function test_brand_association_requires_company_match(): void
    {
        $this->actingAs($this->user);

        // Create a brand from a different company
        $otherCompany = Company::factory()->create();
        $brand = Brand::factory()->create(['company_id' => $otherCompany->id]);

        $this->expectException(QueryException::class);

        $this->user->brands()->attach($brand->id, [
            'company_id' => $otherCompany->id,
            'role' => 'employee',
            'is_primary' => false,
        ]);
    }

    #[Test]
    public function test_brand_association_can_be_removed(): void
    {
        $this->actingAs($this->user);

        $brand = Brand::factory()->create(['company_id' => $this->company->id]);

        $this->user->brands()->attach($brand->id, [
            'role' => 'employee',
            'is_primary' => false,
            'company_id' => $this->company->id,
        ]);

        $this->assertCount(1, $this->user->brands);

        $this->user->brands()->detach($brand->id);
        $this->user = $this->user->fresh();

        $this->assertCount(0, $this->user->brands);
        $this->assertDatabaseMissing('user_brands', [
            'user_id' => $this->user->id,
            'brand_id' => $brand->id,
        ]);
    }
}
