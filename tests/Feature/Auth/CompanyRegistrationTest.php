<?php

namespace Tests\Feature\Auth;

use App\Models\Company;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;
use App\Mail\VerificationCodeMail;
use Tests\InertiaTestHelpers;

class CompanyRegistrationTest extends TestCase
{
    use RefreshDatabase, InertiaTestHelpers;

    protected function setUp(): void
    {
        parent::setUp();
        
        // Setup Inertia testing
        $this->setupInertiaTest();
    }

    public function test_company_registration_page_can_be_rendered()
    {
        $this->withoutExceptionHandling();
        $response = $this->get('/register-company');
        $response->assertStatus(200);
    }

    public function test_contact_validation_step()
    {
        // Fake the mail service
        Mail::fake();

        // Test with email
        $response = $this->postJson('/register-company/validate-contact', [
            'contact' => 'test@example.com',
            'contact_type' => 'email',
        ]);

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'next_step' => 'verify_code',
            ]);

        // Assert that a verification code was stored in the session
        $this->assertTrue(Session::has('registration_data'));
        $registrationData = Session::get('registration_data');
        $this->assertEquals('test@example.com', $registrationData['contact']);
        $this->assertEquals('email', $registrationData['contact_type']);
        $this->assertFalse($registrationData['verified']);
        $this->assertNotEmpty($registrationData['verification_code']);

        // Assert that a verification email was sent
        Mail::assertSent(VerificationCodeMail::class, function ($mail) use ($registrationData) {
            return $mail->hasTo('test@example.com') && 
                   $mail->verificationCode === $registrationData['verification_code'];
        });
    }

    public function test_verification_code_step()
    {
        // Setup session with verification data
        $verificationCode = '123456';
        Session::put('registration_data', [
            'contact' => 'test@example.com',
            'contact_type' => 'email',
            'verification_code' => $verificationCode,
            'verified' => false,
        ]);

        // Test with correct verification code
        $response = $this->postJson('/register-company/verify-code', [
            'verification_code' => $verificationCode,
        ]);

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'next_step' => 'company_details',
            ]);

        // Assert that the verification status was updated in the session
        $registrationData = Session::get('registration_data');
        $this->assertTrue($registrationData['verified']);
    }

    public function test_save_company_details_step()
    {
        // Setup session with verified data
        Session::put('registration_data', [
            'contact' => 'admin@example.com',
            'contact_type' => 'email',
            'verification_code' => '123456',
            'verified' => true,
        ]);

        // Test saving company details
        $response = $this->postJson('/register-company/save-details', [
            'company_name' => 'Test Company',
            'admin_name' => 'Admin User',
            'admin_email' => 'admin@example.com',
            'admin_password' => 'password',
        ]);

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'message' => 'Registration completed successfully',
                'redirect' => route('dashboard'),
            ]);

        // Assert that the company and admin user were created
        $this->assertDatabaseHas('companies', [
            'name' => 'Test Company',
        ]);

        $this->assertDatabaseHas('users', [
            'name' => 'Admin User',
            'email' => 'admin@example.com',
        ]);

        // Assert that the user is authenticated
        $this->assertAuthenticated();
    }

    public function test_full_registration_flow()
    {
        Mail::fake();

        // Step 1: Contact validation
        $this->postJson('/register-company/validate-contact', [
            'contact' => 'flow@example.com',
            'contact_type' => 'email',
        ]);

        // Get the verification code from session
        $registrationData = Session::get('registration_data');
        $verificationCode = $registrationData['verification_code'];

        // Step 2: Verify code
        $this->postJson('/register-company/verify-code', [
            'verification_code' => $verificationCode,
        ]);

        // Step 3: Save company details
        $response = $this->postJson('/register-company/save-details', [
            'company_name' => 'Flow Company',
            'admin_name' => 'Flow Admin',
            'admin_email' => 'flow@example.com',
            'admin_password' => 'password',
        ]);

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'message' => 'Registration completed successfully',
                'redirect' => route('dashboard'),
            ]);

        // Assert that the company and admin user were created
        $this->assertDatabaseHas('companies', [
            'name' => 'Flow Company',
        ]);

        $this->assertDatabaseHas('users', [
            'name' => 'Flow Admin',
            'email' => 'flow@example.com',
        ]);

        // Assert that the user is authenticated
        $this->assertAuthenticated();
    }
}
