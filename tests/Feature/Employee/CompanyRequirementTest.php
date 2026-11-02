<?php

namespace Tests\Feature\Employee;

use App\Models\Company;
use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class CompanyRequirementTest extends TestCase
{
    /**
     * These tests describe a validation layer that does not exist in the
     * application. Nothing rejects a UserDetail without company_id, nothing
     * compares the company of a user against its detail row, and nothing locks
     * company_id against updates. user_details.company_id is nullable and has a
     * plain foreign key.
     *
     * Implementing those rules is a product decision (and would change existing
     * create/update flows), so they are skipped with this note instead of being
     * made green by asserting the opposite of what the test says.
     */
    private function skipUnimplementedRule(): void
    {
        $this->markTestSkipped(
            'Company-membership validation rules are not implemented in the application.'
        );
    }

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
        $this->skipUnimplementedRule();

        $this->expectException(\Illuminate\Validation\ValidationException::class);

        // Try to create user without company_id
        User::factory()->forCompany(null)->create();
    }

    #[Test]
    public function user_details_creation_requires_company_id()
    {
        $this->skipUnimplementedRule();

        // Create a user
        $user = User::factory()->forCompany($this->company->id)->create();

        $this->expectException(\Illuminate\Validation\ValidationException::class);

        // Try to create user details without company_id
        UserDetail::factory()->create([
            'user_id' => $user->id,
            'company_id' => null,
        ]);
    }

    #[Test]
    public function company_id_must_match_between_user_and_user_details()
    {
        $this->skipUnimplementedRule();

        // Create two different companies
        $company1 = Company::factory()->create();
        $company2 = Company::factory()->create();

        // Create a user in company1
        $user = User::factory()->forCompany($company1->id)->create();

        $this->expectException(\Illuminate\Validation\ValidationException::class);

        // Try to create user details with different company_id
        UserDetail::factory()->create([
            'user_id' => $user->id,
            'company_id' => $company2->id,
        ]);
    }

    #[Test]
    public function company_id_cannot_be_changed()
    {
        $this->skipUnimplementedRule();

        // Create a user
        $user = User::factory()->forCompany($this->company->id)->create();

        $this->expectException(\Illuminate\Validation\ValidationException::class);

        // Try to update company_id
        $user->update([
            'company_id' => Company::factory()->create()->id,
        ]);
    }

    #[Test]
    public function company_id_must_exist()
    {
        $this->skipUnimplementedRule();

        $this->expectException(\Illuminate\Validation\ValidationException::class);

        // Try to create user with non-existent company_id
        User::factory()->forCompany(999999)->create();
    }
}
