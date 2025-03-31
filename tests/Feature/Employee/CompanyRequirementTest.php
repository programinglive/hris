<?php

namespace Tests\Feature\Employee;

use App\Models\User;
use App\Models\UserDetail;
use App\Models\Company;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class CompanyRequirementTest extends TestCase
{
    use RefreshDatabase;

    protected $company;

    protected function setUp(): void
    {
        parent::setUp();
        
        // Create a company
        $this->company = Company::factory()->create();
    }

    #[Test]
    public function user_creation_requires_company_id()
    {
        $this->expectException(\Illuminate\Validation\ValidationException::class);

        // Try to create user without company_id
        User::factory()->create([
            'company_id' => null
        ]);
    }

    #[Test]
    public function user_details_creation_requires_company_id()
    {
        // Create a user
        $user = User::factory()->create([
            'company_id' => $this->company->id
        ]);

        $this->expectException(\Illuminate\Validation\ValidationException::class);

        // Try to create user details without company_id
        UserDetail::factory()->create([
            'user_id' => $user->id,
            'company_id' => null
        ]);
    }

    #[Test]
    public function company_id_must_match_between_user_and_user_details()
    {
        // Create two different companies
        $company1 = Company::factory()->create();
        $company2 = Company::factory()->create();

        // Create a user in company1
        $user = User::factory()->create([
            'company_id' => $company1->id
        ]);

        $this->expectException(\Illuminate\Validation\ValidationException::class);

        // Try to create user details with different company_id
        UserDetail::factory()->create([
            'user_id' => $user->id,
            'company_id' => $company2->id
        ]);
    }

    #[Test]
    public function company_id_cannot_be_changed()
    {
        // Create a user
        $user = User::factory()->create([
            'company_id' => $this->company->id
        ]);

        $this->expectException(\Illuminate\Validation\ValidationException::class);

        // Try to update company_id
        $user->update([
            'company_id' => Company::factory()->create()->id
        ]);
    }

    #[Test]
    public function company_id_must_exist()
    {
        $this->expectException(\Illuminate\Validation\ValidationException::class);

        // Try to create user with non-existent company_id
        User::factory()->create([
            'company_id' => 999999 // Non-existent company
        ]);
    }
}
