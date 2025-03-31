<?php

namespace Tests\Feature\Organization;

use App\Models\Company;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Inertia\Testing\AssertableInertia as Assert;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class CompanyRegistrationTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected $verificationCode;

    protected function setUp(): void
    {
        parent::setUp();
        
        // Store timestamp for consistent testing
        $this->timestamp = time();
    }

    #[Test]
    public function registration_page_can_be_rendered()
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

        Mail::assertSent(\App\Mail\VerificationCodeMail::class, function ($mail) use ($registrationData) {
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
            'contact' => 'test'.$this->timestamp.'@example.com',
            'contact_type' => 'email',
            'verification_code' => '123456',
            'verified' => true,
        ]);

        $response = $this->postJson('/register-company/save-details', [
            'company_name' => 'Test Company',
            'admin_name' => 'Test Admin',
            'admin_email' => 'admin'.$this->timestamp.'@example.com',
            'admin_password' => 'password123',
        ]);

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'message' => 'Registration completed successfully',
            ]);

        $user = User::first();
        $company = Company::first();

        $this->assertNotNull($user);
        $this->assertNotNull($company);
        $this->assertEquals($user->id, $company->owner_id);
        $this->assertEquals('Test Company', $company->name);

        // Verify main branch was created
        $mainBranch = $company->branches()->where('is_main_branch', true)->first();
        $this->assertNotNull($mainBranch);
        $this->assertEquals('Main Branch', $mainBranch->name);
    }

    #[Test]
    public function company_email_must_be_unique()
    {
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
}
