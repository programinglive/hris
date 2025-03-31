<?php

namespace Tests\Feature\UI;

use App\Models\Company;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;

class CompanyRegistrationUITest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Clear session before each test
        $this->app['session']->flush();
    }

    #[Test]
    public function it_redirects_to_registration_wizard_when_no_companies_exist()
    {
        $response = $this->get('/login');
        $response->assertRedirect(route('landing-page.installation-wizard'));
    }

    #[Test]
    public function it_shows_contact_form_with_validation()
    {
        $response = $this->get(route('landing-page.installation-wizard'));
        $response->assertInertia(fn (Assert $page) => $page->component('auth/register-company')
        );

        // Test invalid contact submission
        $response = $this->postJson(route('register.company.validate-contact'), [
            'contact' => 'invalid-email',
            'contact_type' => 'email',
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['contact']);

        // Test valid contact submission
        $response = $this->postJson(route('register.company.validate-contact'), [
            'contact' => 'test@example.com',
            'contact_type' => 'email',
        ]);

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'message' => 'Verification code sent to test@example.com',
                'next_step' => 'verify_code',
            ]);
    }

    #[Test]
    public function it_shows_verification_form_after_valid_contact()
    {
        // First validate contact
        $response = $this->postJson(route('register.company.validate-contact'), [
            'contact' => 'test@example.com',
            'contact_type' => 'email',
        ]);

        $response->assertStatus(200);

        // Check if we're on verification step
        $response = $this->get(route('landing-page.installation-wizard'));
        $response->assertInertia(fn (Assert $page) => $page->component('auth/register-company')
        );

        // Verify session data
        $this->assertNotEmpty(session('registration_data'));
        $this->assertEquals('test@example.com', session('registration_data.contact'));
        $this->assertEquals('email', session('registration_data.contact_type'));
        $this->assertFalse(session('registration_data.verified'));
    }

    #[Test]
    public function it_shows_company_details_form_after_verification()
    {
        // First validate contact
        $response = $this->postJson(route('register.company.validate-contact'), [
            'contact' => 'test@example.com',
            'contact_type' => 'email',
        ]);

        $response->assertStatus(200);

        // Get the verification code from session
        $verificationCode = session('registration_data.verification_code');

        // Then verify code
        $response = $this->postJson(route('register.company.verify-code'), [
            'verification_code' => $verificationCode,
        ]);

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'message' => 'Verification successful',
                'next_step' => 'company_details',
            ]);

        // Verify session data
        $this->assertTrue(session('registration_data.verified'));
    }

    #[Test]
    public function it_redirects_to_home_after_successful_registration()
    {
        // First validate contact
        $response = $this->postJson(route('register.company.validate-contact'), [
            'contact' => 'test@example.com',
            'contact_type' => 'email',
        ]);

        $response->assertStatus(200);

        // Get the verification code from session
        $verificationCode = session('registration_data.verification_code');

        // Then verify code
        $response = $this->postJson(route('register.company.verify-code'), [
            'verification_code' => $verificationCode,
        ]);

        $response->assertStatus(200);

        // Finally register company
        $response = $this->postJson(route('register.company.save-details'), [
            'company_name' => 'Test Company',
            'company_email' => 'company@example.com',
            'company_phone' => '1234567890',
            'company_address' => '123 Main St',
            'company_city' => 'New York',
            'company_country' => 'USA',
            'admin_name' => 'Test Admin',
            'admin_email' => 'admin@example.com',
            'admin_password' => 'password123',
            'admin_password_confirmation' => 'password123',
        ]);

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'message' => 'Registration completed successfully',
            ]);

        // Verify company was created
        $this->assertDatabaseHas('companies', [
            'name' => 'Test Company',
        ]);
    }
}
