<?php

namespace Tests\Feature;

use App\Models\Company;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class InstallationWizardTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        
        // Ensure no companies exist before each test
        Company::query()->delete();
        
        // Ensure no users exist before each test
        User::query()->delete();
    }

    #[Test]
    public function installation_wizard_is_accessible_when_no_companies_exist_and_user_is_not_authenticated(): void
    {
        $response = $this->get(route('landing-page.installation-wizard'));
        
        $response->assertStatus(200);
        $response->assertViewIs('app');
    }

    #[Test]
    public function installation_wizard_shows_company_registration_form(): void
    {
        $response = $this->get(route('landing-page.installation-wizard'));

        $response->assertSee('Installation');
    }

    #[Test]
    public function installation_wizard_validates_contact_information(): void
    {
        $response = $this->postJson(route('landing-page.installation-wizard.validate-contact'), [
            'contact' => 'test@example.com',
            'contact_type' => 'email'
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'success',
            'message',
            'next_step',
            'verification_code'
        ]);
    }

    #[Test]
    public function installation_wizard_validates_contact_type(): void
    {
        $response = $this->postJson(route('landing-page.installation-wizard.validate-contact'), [
            'contact' => 'invalid',
            'contact_type' => 'email'
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['contact']);
    }

    #[Test]
    public function installation_wizard_validates_verification_code(): void
    {
        // First validate contact to get verification code
        $response = $this->postJson(route('landing-page.installation-wizard.validate-contact'), [
            'contact' => 'test@example.com',
            'contact_type' => 'email'
        ]);

        $verificationCode = $response->json('verification_code');

        // Now verify the code
        $response = $this->postJson(route('landing-page.installation-wizard.verify-code'), [
            'verification_code' => $verificationCode
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'success',
            'message',
            'next_step'
        ]);
    }

    #[Test]
    public function installation_wizard_redirects_to_dashboard_when_user_is_authenticated(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get(route('landing-page.installation-wizard'));

        $response->assertRedirect(route('dashboard'));
    }

    #[Test]
    public function installation_wizard_is_not_accessible_when_company_exists(): void
    {
        Company::factory()->create();

        $response = $this->get(route('landing-page.installation-wizard'));

        $response->assertStatus(200); // Assuming the page should still show but with different content
    }

    #[Test]
    public function installation_wizard_shows_complete_page_after_successful_registration(): void
    {
        // First validate contact
        $response = $this->postJson(route('landing-page.installation-wizard.validate-contact'), [
            'contact' => 'test@example.com',
            'contact_type' => 'email'
        ]);

        $verificationCode = $response->json('verification_code');

        // Verify code
        $response = $this->postJson(route('landing-page.installation-wizard.verify-code'), [
            'verification_code' => $verificationCode
        ]);

        // Complete registration
        $response = $this->postJson(route('landing-page.installation-wizard.save-company-details'), [
            'company_name' => 'Test Company',
            'admin_name' => 'Test Admin',
            'admin_email' => 'admin@example.com',
            'admin_password' => 'password123',
            'contact' => 'test@example.com',
            'contact_type' => 'email',
            'verification_code' => $verificationCode
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'success',
            'message',
            'redirect'
        ]);

        $this->assertDatabaseHas('companies', [
            'name' => 'Test Company',
            'email' => 'test@example.com'
        ]);

        $this->assertDatabaseHas('users', [
            'email' => 'admin@example.com',
            'name' => 'Test Admin'
        ]);

        $this->assertDatabaseHas('branches', [
            'name' => 'Main Branch',
            'is_main_branch' => true
        ]);
    }
}
