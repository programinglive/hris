<?php

namespace Tests\Feature\Organization;

use App\Models\Company;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Session;
use Inertia\Testing\AssertableInertia as Assert;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class CompanyRegistrationControllerTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function registration_form_can_be_displayed()
    {
        $this->get(route('landing-page.installation-wizard'))
            ->assertInertia(fn (Assert $page) => $page
                ->component('auth/register-company')
                ->where('title', 'Installation')
                ->has('flash', fn (Assert $flash) => $flash
                    ->missing('verification_code')
                    ->has('message')
                )
                ->has('errors', fn (Assert $errors) => $errors
                    ->count(0)
                )
                ->missing('deferred')
            );
    }

    #[Test]
    public function contact_information_can_be_validated()
    {
        // Test email validation
        $response = $this->post(route('landing-page.installation-wizard.validate-contact'), [
            'contact' => 'test@example.com',
            'contact_type' => 'email',
        ]);

        $response->assertSessionHas('success', 'Verification code sent to test@example.com');

        $sessionData = Session::get('registration_data');
        $this->assertNotEmpty($sessionData);
        $this->assertEquals('test@example.com', $sessionData['contact']);
        $this->assertEquals('email', $sessionData['contact_type']);
        $this->assertNotNull($sessionData['verification_code']);
        $this->assertEquals(6, strlen($sessionData['verification_code']));
        $this->assertFalse($sessionData['verified']);
        $this->assertNotNull($sessionData['expires_at']);

        // Test phone validation
        $response = $this->post(route('landing-page.installation-wizard.validate-contact'), [
            'contact' => '+1234567890',
            'contact_type' => 'phone',
        ]);

        $response->assertSessionHas('success', 'Verification code sent to +1234567890');

        $sessionData = Session::get('registration_data');
        $this->assertNotEmpty($sessionData);
        $this->assertEquals('+1234567890', $sessionData['contact']);
        $this->assertEquals('phone', $sessionData['contact_type']);
        $this->assertNotNull($sessionData['verification_code']);
        $this->assertEquals(6, strlen($sessionData['verification_code']));
        $this->assertFalse($sessionData['verified']);
        $this->assertNotNull($sessionData['expires_at']);
    }

    #[Test]
    public function contact_information_validation_fails_with_invalid_data()
    {
        // Test invalid email format
        $response = $this->post(route('landing-page.installation-wizard.validate-contact'), [
            'contact' => 'invalid-email',
            'contact_type' => 'email',
        ]);

        $response->assertSessionHasErrors('contact', 'The contact must be a valid email address.');

        // Test invalid phone format
        $response = $this->post(route('landing-page.installation-wizard.validate-contact'), [
            'contact' => 'invalid-phone',
            'contact_type' => 'phone',
        ]);

        $response->assertSessionHasErrors('contact', 'The contact must only contain numbers, plus signs, and spaces.');

        // Test empty contact
        $response = $this->post(route('landing-page.installation-wizard.validate-contact'), [
            'contact' => '',
            'contact_type' => 'email',
        ]);

        $response->assertSessionHasErrors('contact', 'The contact field is required.');

        // Test invalid contact type
        $response = $this->post(route('landing-page.installation-wizard.validate-contact'), [
            'contact' => 'test@example.com',
            'contact_type' => 'invalid',
        ]);

        $response->assertSessionHasErrors('contact_type', 'The selected contact type is invalid.');
    }

    #[Test]
    public function contact_information_validation_fails_with_duplicate_contact()
    {
        // Create existing company with email and phone
        Company::factory()->create([
            'email' => 'existing@example.com',
            'phone' => '+1234567890',
        ]);

        // Test duplicate email
        $response = $this->post(route('landing-page.installation-wizard.validate-contact'), [
            'contact' => 'existing@example.com',
            'contact_type' => 'email',
        ]);

        $response->assertSessionHasErrors('contact', 'The contact has already been taken.');

        // Test duplicate phone
        $response = $this->post(route('landing-page.installation-wizard.validate-contact'), [
            'contact' => '+1234567890',
            'contact_type' => 'phone',
        ]);

        $response->assertSessionHasErrors('contact', 'The contact has already been taken.');
    }

    #[Test]
    public function verification_code_can_be_verified()
    {
        // Store registration data in session
        Session::put('registration_data', [
            'contact' => 'test@example.com',
            'contact_type' => 'email',
            'verification_code' => '123456',
            'verified' => false,
            'expires_at' => now()->addMinutes(5),
            'created_at' => now(),
        ]);

        $response = $this->post(route('landing-page.installation-wizard.verify-code'), [
            'verification_code' => '123456',
        ]);

        $response->assertRedirect(route('landing-page.installation-wizard.save-company-details'));
        $this->assertEquals(true, Session::get('registration_data.verified'));
    }

    #[Test]
    public function verification_code_fails_with_invalid_code()
    {
        // Store registration data in session
        Session::put('registration_data', [
            'contact' => 'test@example.com',
            'contact_type' => 'email',
            'verification_code' => '123456',
            'verified' => false,
            'expires_at' => now()->addMinutes(5),
        ]);

        $response = $this->post(route('landing-page.installation-wizard.verify-code'), [
            'verification_code' => '654321',
        ]);

        $response->assertSessionHasErrors('verification_code', 'The verification code is invalid.');
    }

    #[Test]
    public function verification_code_fails_when_expired()
    {
        // Store expired registration data in session
        Session::put('registration_data', [
            'contact' => 'test@example.com',
            'contact_type' => 'email',
            'verification_code' => '123456',
            'verified' => false,
            'expires_at' => now()->subMinutes(6),
        ]);

        $response = $this->post(route('landing-page.installation-wizard.verify-code'), [
            'verification_code' => '123456',
        ]);

        $response->assertSessionHasErrors('verification_code', 'The verification code has expired.');
    }

    #[Test]
    public function company_details_can_be_registered()
    {
        // Store verified registration data in session
        Session::put('registration_data', [
            'contact' => 'test@example.com',
            'contact_type' => 'email',
            'verification_code' => '123456',
            'verified' => true,
            'expires_at' => now()->addMinutes(5),
        ]);

        $response = $this->post(route('landing-page.installation-wizard.save-company-details'), [
            'company_name' => 'Test Company',
            'company_email' => 'test@example.com',
            'company_phone' => '+1234567890',
            'company_address' => '123 Test Street',
            'company_city' => 'Test City',
            'company_state' => 'Test State',
            'company_postal_code' => '12345',
            'company_country' => 'Test Country',
            'company_timezone' => 'UTC',
            'company_currency' => 'USD',
            'company_language' => 'en',
            'admin_name' => 'Test Admin',
            'admin_email' => 'admin@example.com',
            'admin_password' => 'password123',
            'admin_password_confirmation' => 'password123',
            'contact_type' => 'email',
            'contact' => 'test@example.com',
            'verification_code' => '123456',
        ]);

        $response->assertRedirect(route('dashboard'));
        $this->assertDatabaseHas('companies', ['name' => 'Test Company']);
        $this->assertDatabaseHas('users', ['email' => 'admin@example.com']);
    }

    #[Test]
    public function company_registration_fails_with_invalid_details()
    {
        // Store verified registration data in session
        Session::put('registration_data', [
            'contact' => 'test@example.com',
            'contact_type' => 'email',
            'verification_code' => '123456',
            'verified' => true,
            'expires_at' => now()->addMinutes(5),
        ]);

        $response = $this->post(route('landing-page.installation-wizard.save-company-details'), [
            'company_name' => '', // Required field
            'company_email' => 'invalid-email', // Invalid email
            'company_phone' => 'invalid-phone', // Invalid phone
            'company_address' => '', // Required field
            'company_city' => '', // Required field
            'company_country' => '', // Required field
            'admin_name' => '', // Required field
            'admin_email' => 'invalid-email', // Invalid email
            'admin_password' => '', // Required field
            'admin_password_confirmation' => '', // Required field
            'contact_type' => '', // Required field
            'contact' => '', // Required field
            'verification_code' => '', // Required field
        ]);

        $response->assertSessionHasErrors([
            'company_name' => 'The company name field is required.',
            'company_email' => 'The company email field must be a valid email address.',
            'company_address' => 'The company address field is required.',
            'company_city' => 'The company city field is required.',
            'company_country' => 'The company country field is required.',
            'admin_name' => 'The admin name field is required.',
            'admin_email' => 'The admin email field must be a valid email address.',
            'admin_password' => 'The admin password field is required.',
            'contact_type' => 'The contact type field is required.',
            'contact' => 'The contact field is required.',
        ]);
    }
}
