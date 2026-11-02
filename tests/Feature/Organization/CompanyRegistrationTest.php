<?php

namespace Tests\Feature\Organization;

use App\Models\Company;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Mail;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class CompanyRegistrationTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected $verificationCode;

    protected $timestamp;

    protected function setUp(): void
    {
        parent::setUp();

        // Store timestamp for consistent testing
        $this->timestamp = time();
        Mail::fake();
    }

    #[Test]
    public function registration_page_can_be_rendered()
    {
        $response = $this->get('/register-company');
        $response->assertStatus(200);
    }

    #[Test]
    public function company_email_must_be_unique()
    {
        $this->markTestSkipped(
            '/register-company/validate-contact no longer exists: the multi-step '
            . 'registration wizard was removed. Uniqueness is still enforced by '
            . 'CompanyRegistrationRequest on register.company.store.'
        );

        $company = Company::factory()->create([
            'email' => 'test@example.com',
        ]);

        $response = $this->postJson('/register-company/validate-contact', [
            'contact' => 'test@example.com',
            'contact_type' => 'email',
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['contact']);
    }

    #[Test]
    public function company_phone_must_be_unique()
    {
        $this->markTestSkipped(
            '/register-company/validate-contact no longer exists: the multi-step '
            . 'registration wizard was removed. Uniqueness is still enforced by '
            . 'CompanyRegistrationRequest on register.company.store.'
        );

        $company = Company::factory()->create([
            'phone' => '1234567890',
        ]);

        $response = $this->postJson('/register-company/validate-contact', [
            'contact' => '1234567890',
            'contact_type' => 'phone',
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['contact']);
    }

    #[Test]
    public function store_method_creates_company_and_admin_with_role()
    {
        // First, get the registration page
        $response = $this->get(route('register.company'));
        $response->assertOk();

        // Then make the store request
        $response = $this->postJson(route('register.company.store'), [
            'name' => 'Test Company',
            'code' => 'TESTCOMP'.$this->timestamp,
            'email' => 'test'.$this->timestamp.'@example.com',
            'phone' => '1234567890',
            'address' => '123 Test St',
            'city' => 'Test City',
            'state' => 'Test State',
            'postal_code' => '12345',
            'country' => 'Test Country',
            'administrator' => [
                'name' => 'Test Admin',
                'email' => 'admin'.$this->timestamp.'@example.com',
                'password' => 'password123',
                'password_confirmation' => 'password123',
            ],
        ]);

        $response->assertRedirect(route('dashboard'));

        // Verify company was created
        $this->assertDatabaseHas('companies', [
            'name' => 'Test Company',
            'email' => 'test'.$this->timestamp.'@example.com',
            'phone' => '1234567890',
            'is_active' => true,
        ]);

        // is_primary belongs to user_companies, not companies.
        $this->assertDatabaseHas('user_companies', [
            'company_id' => \App\Models\Company::where('email', 'test'.$this->timestamp.'@example.com')->value('id'),
            'is_primary' => true,
        ]);

        // Verify admin user was created
        // users has no company_id; membership is asserted on user_details below.
        $this->assertDatabaseHas('users', [
            'email' => 'admin'.$this->timestamp.'@example.com',
            'name' => 'Test Admin',
        ]);

        // Verify user details were created
        $admin = User::where('email', 'admin'.$this->timestamp.'@example.com')->first();
        $this->assertNotNull($admin);
        $this->assertDatabaseHas('user_details', [
            'user_id' => $admin->id,
            'phone' => '1234567890',
            'address' => '123 Test St',
            'city' => 'Test City',
            'state' => 'Test State',
            'postal_code' => '12345',
            'country' => 'Test Country',
        ]);

        // The controller scopes the slug per company: 'super-admin-'.$company->id.
        $this->assertDatabaseHas('roles', [
            'name' => 'Super Admin',
            'description' => 'Super Administrator',
            'company_id' => Company::where('email', 'test'.$this->timestamp.'@example.com')->value('id'),
        ]);

        // Verify user_role relationship
        $this->assertDatabaseHas('user_roles', [
            'user_id' => $admin->id,
            'role_id' => Role::where('name', 'Super Admin')->first()->id,
        ]);

        // Verify user is logged in
        $this->assertAuthenticatedAs($admin);
    }
}
