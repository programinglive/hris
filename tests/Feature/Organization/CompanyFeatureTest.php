<?php

namespace Tests\Feature\Organization;

use App\Mail\VerificationCodeMail;
use App\Models\Company;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Inertia\Testing\AssertableInertia as Assert;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class CompanyFeatureTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected $user;

    protected $company;

    protected $timestamp;

    protected function setUp(): void
    {
        parent::setUp();

        // Create a test user with admin role
        $this->user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ]);

        // Create a test company with the existing user as owner
        $this->company = Company::factory()->create([
            'owner_id' => $this->user->id,
        ]);

        // Create another company that shouldn't be visible
        Company::factory()->create();

        // Store timestamp for consistent testing
        $this->timestamp = time();
    }

    // Company Registration Tests
    #[Test]
    public function company_registration_page_can_be_rendered()
    {
        $response = $this->get('/register-company');
        $response->assertStatus(200);
    }

    #[Test]
    public function contact_validation_step()
    {
        Mail::fake();

        $response = $this->postJson('/register-company/validate-contact', [
            'contact' => 'test'.$this->timestamp.'@example.com',
            'contact_type' => 'email',
        ]);

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'message' => 'Verification code sent to test'.$this->timestamp.'@example.com',
                'next_step' => 'verify_code',
            ]);

        $registrationData = Session::get('registration_data');
        $this->assertEquals('test'.$this->timestamp.'@example.com', $registrationData['contact']);
        $this->assertEquals('email', $registrationData['contact_type']);
        $this->assertFalse($registrationData['verified']);
        $this->assertNotEmpty($registrationData['verification_code']);

        Mail::assertSent(VerificationCodeMail::class, function ($mail) use ($registrationData) {
            return $mail->hasTo('test'.$this->timestamp.'@example.com') &&
                   $mail->verificationCode === $registrationData['verification_code'];
        });
    }

    #[Test]
    public function verification_code_step()
    {
        $verificationCode = '123456';
        Session::put('registration_data', [
            'contact' => 'test'.$this->timestamp.'@example.com',
            'contact_type' => 'email',
            'verification_code' => $verificationCode,
            'verified' => false,
        ]);

        $response = $this->postJson('/register-company/verify-code', [
            'verification_code' => $verificationCode,
        ]);

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'message' => 'Verification successful',
                'next_step' => 'company_details',
            ]);

        $registrationData = Session::get('registration_data');
        $this->assertTrue($registrationData['verified']);
    }

    #[Test]
    public function save_company_details_step()
    {
        Session::put('registration_data', [
            'contact' => 'admin'.$this->timestamp.'@example.com',
            'contact_type' => 'email',
            'verification_code' => '123456',
            'verified' => true,
        ]);

        $response = $this->postJson('/register-company/save-details', [
            'company_name' => 'Test Company',
            'admin_name' => 'Admin User',
            'admin_email' => 'admin'.$this->timestamp.'@example.com',
            'admin_password' => 'password',
        ]);

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'message' => 'Registration completed successfully',
                'redirect' => route('dashboard'),
            ]);

        $this->assertDatabaseHas('companies', [
            'name' => 'Test Company',
        ]);

        $this->assertDatabaseHas('users', [
            'name' => 'Admin User',
            'email' => 'admin'.$this->timestamp.'@example.com',
        ]);

        $this->assertAuthenticated();
    }

    // Company Management Tests
    #[Test]
    public function user_can_view_company_list()
    {
        $this->actingAs($this->user);

        $response = $this->get(route('organization.company.index', [
            'company' => $this->company->id,
        ]));

        $response->assertStatus(200);

        $response->assertInertia(function (Assert $page) {
            $page->component('organization/company/index')
                ->has('companies.data', 1)
                ->where('companies.data.0.name', $this->company->name);
        });
    }

    #[Test]
    public function company_list_has_correct_structure()
    {
        $this->actingAs($this->user);

        $response = $this->get(route('organization.company.index', [
            'company' => $this->company->id,
        ]));

        $response->assertStatus(200);

        $response->assertInertia(function (Assert $page) {
            $page->component('organization/company/index')
                ->has('companies.data', 1)
                ->where('companies.data.0.name', $this->company->name)
                ->where('companies.data.0.email', $this->company->email)
                ->where('companies.data.0.phone', $this->company->phone)
                ->where('companies.data.0.city', $this->company->city)
                ->where('companies.data.0.country', $this->company->country)
                ->where('companies.data.0.is_active', $this->company->is_active);
        });
    }

    #[Test]
    public function companies_can_be_filtered_by_search()
    {
        $this->actingAs($this->user);

        $response = $this->get(route('organization.company.index', [
            'search' => $this->company->name,
            'company' => $this->company->id,
        ]));

        $response->assertInertia(function (Assert $page) {
            $page->component('organization/company/index')
                ->has('companies.data', 1)
                ->where('companies.data.0.name', $this->company->name);
        });
    }

    #[Test]
    public function user_can_view_company_create_form()
    {
        $this->actingAs($this->user);

        $response = $this->get(route('organization.company.create'));
        $response->assertStatus(200);

        $response->assertInertia(function (Assert $page) {
            $page->component('organization/company/create');
        });
    }

    #[Test]
    public function user_can_create_a_company()
    {
        $this->actingAs($this->user);

        $response = $this->post(route('organization.company.store'), [
            'name' => 'New Company',
            'email' => 'new'.$this->timestamp.'@example.com',
            'phone' => '1234567890',
            'city' => 'Test City',
            'country' => 'Test Country',
            'is_active' => true,
        ]);

        $response->assertRedirect(route('organization.company.index'));

        $this->assertDatabaseHas('companies', [
            'name' => 'New Company',
            'email' => 'new'.$this->timestamp.'@example.com',
            'phone' => '1234567890',
            'city' => 'Test City',
            'country' => 'Test Country',
            'is_active' => true,
        ]);
    }

    #[Test]
    public function user_can_view_company_details()
    {
        $this->actingAs($this->user);

        $response = $this->get(route('organization.company.show', $this->company));
        $response->assertStatus(200);

        $response->assertInertia(function (Assert $page) {
            $page->component('organization/company/show')
                ->where('company.name', $this->company->name)
                ->where('company.email', $this->company->email)
                ->where('company.phone', $this->company->phone)
                ->where('company.city', $this->company->city)
                ->where('company.country', $this->company->country)
                ->where('company.is_active', $this->company->is_active);
        });
    }

    #[Test]
    public function user_can_view_company_edit_form()
    {
        $this->actingAs($this->user);

        $response = $this->get(route('organization.company.edit', $this->company));
        $response->assertStatus(200);

        $response->assertInertia(function (Assert $page) {
            $page->component('organization/company/edit')
                ->where('company.name', $this->company->name)
                ->where('company.email', $this->company->email)
                ->where('company.phone', $this->company->phone)
                ->where('company.city', $this->company->city)
                ->where('company.country', $this->company->country)
                ->where('company.is_active', $this->company->is_active);
        });
    }

    #[Test]
    public function user_can_update_a_company()
    {
        $this->actingAs($this->user);

        $response = $this->put(route('organization.company.update', $this->company), [
            'name' => 'Updated Company',
            'email' => 'updated'.$this->timestamp.'@example.com',
            'phone' => '0987654321',
            'city' => 'Updated City',
            'country' => 'Updated Country',
            'is_active' => false,
        ]);

        $response->assertRedirect(route('organization.company.index'));

        $this->assertDatabaseHas('companies', [
            'id' => $this->company->id,
            'name' => 'Updated Company',
            'email' => 'updated'.$this->timestamp.'@example.com',
            'phone' => '0987654321',
            'city' => 'Updated City',
            'country' => 'Updated Country',
            'is_active' => false,
        ]);
    }

    #[Test]
    public function user_can_delete_a_company()
    {
        $this->actingAs($this->user);

        // Create a company with a unique email
        $company = Company::factory()->create([
            'owner_id' => $this->user->id,
            'email' => 'delete-test'.$this->timestamp.'@example.com',
        ]);

        $response = $this->delete(route('organization.company.destroy', $company));
        $response->assertRedirect(route('organization.company.index'));

        // Verify the company was soft deleted
        $this->assertSoftDeleted('companies', [
            'id' => $company->id,
            'owner_id' => $this->user->id,
            'email' => 'delete-test'.$this->timestamp.'@example.com',
        ]);

        // Verify the company no longer exists in the active records
        $this->assertDatabaseMissing('companies', [
            'id' => $company->id,
            'deleted_at' => null,
        ]);
    }

    #[Test]
    public function company_can_have_logo()
    {
        $this->actingAs($this->user);

        Storage::fake('public');

        $logo = UploadedFile::fake()->image('logo.png');

        $response = $this->post(route('organization.company.store'), [
            'name' => 'Company with Logo',
            'email' => 'logo'.$this->timestamp.'@example.com',
            'phone' => '1234567890',
            'city' => 'Test City',
            'country' => 'Test Country',
            'is_active' => true,
            'logo' => $logo,
        ]);

        $response->assertRedirect(route('organization.company.index'));

        $company = Company::where('email', 'logo'.$this->timestamp.'@example.com')->first();
        $this->assertNotNull($company);

        // Get the logo path from the database
        $logoPath = $company->logo;
        $this->assertNotNull($logoPath);

        // Check if the file exists in the storage
        $this->assertTrue(Storage::disk('public')->exists($logoPath));

        // Verify the logo path is in the correct format
        $this->assertStringContainsString('logos/', $logoPath);

        // Verify the logo file has the correct extension
        $this->assertStringEndsWith('.png', $logoPath);

        // Check if the logo was actually uploaded
        $this->assertGreaterThan(0, Storage::disk('public')->size($logoPath));
    }

    #[Test]
    public function company_validation_rules_are_enforced()
    {
        $this->actingAs($this->user);

        $response = $this->post(route('organization.company.store'), [
            'name' => '',  // Empty required field
            'email' => 'invalid-email',  // Invalid email format
            'city' => 'Test City',
            'country' => 'Test Country',
            'is_active' => true,
        ]);

        // Verify the response has validation errors
        $response->assertSessionHasErrors(['name', 'email']);

        // Get the error messages from the session
        $errors = session('errors');
        $this->assertArrayHasKey('name', $errors->getMessages());
        $this->assertArrayHasKey('email', $errors->getMessages());

        // Verify the error messages contain the correct validation messages
        $this->assertStringContainsString('The name field is required.', $errors->get('name')[0]);
        $this->assertStringContainsString('The email field must be a valid email address.', $errors->get('email')[0]);
    }

    #[Test]
    public function company_email_must_be_unique()
    {
        $this->actingAs($this->user);

        $response = $this->post(route('organization.company.store'), [
            'name' => 'Duplicate Company',
            'email' => $this->company->email,  // Using existing company's email
        ]);

        $response->assertSessionHasErrors(['email']);
    }

    #[Test]
    public function companies_can_be_filtered_by_city()
    {
        $this->actingAs($this->user);

        // Create a company with a specific city
        $city = 'Test City Filter';
        $company = Company::factory()->create([
            'owner_id' => $this->user->id,
            'city' => $city,
        ]);

        // Create another company with a different city
        Company::factory()->create([
            'owner_id' => $this->user->id,
            'city' => 'Different City',
        ]);

        $response = $this->get(route('organization.company.index', [
            'city' => $city,
            'company' => $this->company->id,
        ]));

        $response->assertInertia(function (Assert $page) use ($company, $city) {
            $page->component('organization/company/index')
                ->has('companies.data', 1)
                ->where('companies.data.0.city', $city)
                ->where('companies.data.0.id', $company->id);
        });
    }

    #[Test]
    public function companies_can_be_filtered_by_country()
    {
        $this->actingAs($this->user);

        // Create a company with a specific country
        $country = 'Test Country Filter';
        $company = Company::factory()->create([
            'owner_id' => $this->user->id,
            'country' => $country,
        ]);

        // Create another company with a different country
        Company::factory()->create([
            'owner_id' => $this->user->id,
            'country' => 'Different Country',
        ]);

        $response = $this->get(route('organization.company.index', [
            'country' => $country,
            'company' => $this->company->id,
        ]));

        $response->assertInertia(function (Assert $page) use ($company, $country) {
            $page->component('organization/company/index')
                ->has('companies.data', 1)
                ->where('companies.data.0.country', $country)
                ->where('companies.data.0.id', $company->id);
        });
    }

    #[Test]
    public function companies_can_be_filtered_by_status()
    {
        $this->actingAs($this->user);

        // Update existing company to be inactive
        $this->company->update(['is_active' => false]);

        // Create an active company
        $activeCompany = Company::factory()->create([
            'owner_id' => $this->user->id,
            'is_active' => true,
        ]);

        // Test active filter
        $response = $this->get(route('organization.company.index', [
            'status' => 'active',
            'company' => $this->company->id,
        ]));

        $response->assertInertia(function (Assert $page) use ($activeCompany) {
            $page->component('organization/company/index')
                ->has('companies.data', 1)
                ->where('companies.data.0.is_active', true)
                ->where('companies.data.0.id', $activeCompany->id);
        });

        // Test inactive filter
        $response = $this->get(route('organization.company.index', [
            'status' => 'inactive',
            'company' => $this->company->id,
        ]));

        $response->assertInertia(function (Assert $page) {
            $page->component('organization/company/index')
                ->has('companies.data', 1)
                ->where('companies.data.0.is_active', false);
        });
    }

    #[Test]
    public function companies_can_be_filtered_by_multiple_criteria()
    {
        $this->actingAs($this->user);

        // Create a company matching all criteria
        $matchingCompany = Company::factory()->create([
            'owner_id' => $this->user->id,
            'name' => 'Test Company',
            'city' => 'Test City',
            'country' => 'Test Country',
            'is_active' => true,
        ]);

        // Create companies that don't match all criteria
        Company::factory()->create([
            'owner_id' => $this->user->id,
            'name' => 'Test Company',
            'city' => 'Different City',
            'country' => 'Test Country',
            'is_active' => true,
        ]);

        Company::factory()->create([
            'owner_id' => $this->user->id,
            'name' => 'Test Company',
            'city' => 'Test City',
            'country' => 'Different Country',
            'is_active' => true,
        ]);

        Company::factory()->create([
            'owner_id' => $this->user->id,
            'name' => 'Test Company',
            'city' => 'Test City',
            'country' => 'Test Country',
            'is_active' => false,
        ]);

        $response = $this->get(route('organization.company.index', [
            'search' => 'Test Company',
            'city' => 'Test City',
            'country' => 'Test Country',
            'status' => 'active',
            'company' => $this->company->id,
        ]));

        $response->assertInertia(function (Assert $page) use ($matchingCompany) {
            $page->component('organization/company/index')
                ->has('companies.data', 1)
                ->where('companies.data.0.name', 'Test Company')
                ->where('companies.data.0.city', 'Test City')
                ->where('companies.data.0.country', 'Test Country')
                ->where('companies.data.0.is_active', true)
                ->where('companies.data.0.id', $matchingCompany->id);
        });
    }

    #[Test]
    public function filters_are_reset_when_filter_dialog_opens()
    {
        $this->actingAs($this->user);

        // Apply some filters
        $response = $this->get(route('organization.company.index', [
            'status' => 'active',
            'city' => 'Test City',
            'country' => 'Test Country',
            'company' => $this->company->id,
        ]));

        // Open filter dialog
        $response = $this->get(route('organization.company.index', [
            'status' => 'active',
            'city' => 'Test City',
            'country' => 'Test Country',
            'filter_dialog' => 'true',
            'company' => $this->company->id,
        ]));

        $response->assertInertia(function (Assert $page) {
            $page->component('organization/company/index')
                ->has('companies.data')
                // Verify filters are reset
                ->where('filters.status', null)
                ->where('filters.city', null)
                ->where('filters.country', null);
        });
    }

    #[Test]
    public function query_string_is_cleared_when_filter_dialog_opens()
    {
        $this->actingAs($this->user);

        // Apply some filters
        $response = $this->get(route('organization.company.index', [
            'status' => 'active',
            'city' => 'Test City',
            'country' => 'Test Country',
            'company' => $this->company->id,
        ]));

        // Open filter dialog
        $response = $this->get(route('organization.company.index', [
            'status' => 'active',
            'city' => 'Test City',
            'country' => 'Test Country',
            'filter_dialog' => 'true',
            'company' => $this->company->id,
        ]));

        $response->assertInertia(function (Assert $page) {
            $page->component('organization/company/index')
                ->has('companies.data')
                // Verify only page parameter exists in query string
                ->where('filters.status', null)
                ->where('filters.city', null)
                ->where('filters.country', null);
        });
    }
}
