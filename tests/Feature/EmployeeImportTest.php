<?php

namespace Tests\Feature;

use App\Models\Branch;
use App\Models\Company;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class EmployeeImportTest extends TestCase
{
    use RefreshDatabase;

    private string $templatePath = '';

    /**
     * The import test uploads the generated template as if a user had
     * downloaded it, filled it in, and re-uploaded it. `storage/app/public` is
     * git-ignored, so the file has to be produced by the application itself
     * rather than committed as a fixture.
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->templatePath = storage_path('app/public/templates/employee_import_template.xlsx');

        $directory = dirname($this->templatePath);

        if (! is_dir($directory)) {
            mkdir($directory, 0775, true);
        }

        // Render the template through the controller so the fixture always
        // matches what the application actually ships.
        $controller = new \App\Http\Controllers\Employee\EmployeeImportController;
        $response = $controller->downloadTemplate();
        copy($response->getFile()->getPathname(), $this->templatePath);
    }

    protected function tearDown(): void
    {
        if ($this->templatePath !== '' && is_file($this->templatePath)) {
            @unlink($this->templatePath);
        }

        parent::tearDown();
    }

    /**
     * Test that the import template can be downloaded.
     */
    public function test_can_download_import_template()
    {
        // Create a user and authenticate
        $user = User::factory()->create();
        $this->actingAs($user);

        // Make the request to download the template
        $response = $this->get(route('employee.import.template'));

        // Assert that the response is a download response
        $response->assertStatus(200);
        $response->assertHeader('content-disposition', 'attachment; filename=employee_import_template.xlsx');
    }

    /**
     * Test that an Excel file can be imported.
     */
    public function test_can_import_excel_file()
    {
        // Create a user and authenticate
        $user = User::factory()->create(['email_verified_at' => now()]);
        $this->actingAs($user);

        // Create a company and branch for the import
        $company = Company::factory()->create();
        $branch = Branch::factory()->create(['company_id' => $company->id]);

        // Create an uploaded file from the existing template
        $templatePath = $this->templatePath;

        // Ensure the template exists
        $this->assertFileExists($templatePath, 'Employee import template file not found');

        // Create an uploaded file from the template
        $file = new UploadedFile(
            $templatePath,
            'employee_import_template.xlsx',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            null,
            true
        );

        // Make the request to import the file
        $response = $this->postJson(route('employee.import.process'), [
            'file' => $file,
        ]);

        // Assert the response
        $response->assertStatus(200)
            ->assertJsonPath('success', true);

        // Assert that the employee was created in the database
        // The template has a sample employee "John Doe" with email "john.doe@example.com"
        $this->assertDatabaseHas('users', [
            'email' => 'john.doe@example.com',
        ]);

        // Get the user and check if user details were created properly
        $user = User::where('email', 'john.doe@example.com')->first();
        $this->assertNotNull($user);

        $this->assertDatabaseHas('user_details', [
            'user_id' => $user->id,
            'employee_code' => 'EMP001',
            'company_id' => $company->id,
            'branch_id' => $branch->id,
            // user_details.status is an enum of lowercase values
            // (active/inactive/on_leave/terminated); the importer normalises it.
            'status' => 'active',
        ]);
    }

    /**
     * Test validation errors when importing.
     */
    public function test_import_validation_errors()
    {
        // Create a user and authenticate
        $user = User::factory()->create();
        $this->actingAs($user);

        // Create an invalid file (PDF file instead of Excel)
        Storage::fake('local');
        $file = UploadedFile::fake()->create(
            'employees.pdf',
            1000,
            'application/pdf'
        );

        // Make the request to import the file
        $response = $this->postJson(route('employee.import.process'), [
            'file' => $file,
        ]);

        // Assert the response has validation errors
        $response->assertStatus(422)
            ->assertJsonPath('success', false)
            ->assertJsonStructure([
                'success',
                'errors' => ['file'],
            ]);
    }

    /**
     * Test that no file is provided for import.
     */
    public function test_import_no_file_provided()
    {
        // Create a user and authenticate
        $user = User::factory()->create();
        $this->actingAs($user);

        // Make the request without a file
        $response = $this->postJson(route('employee.import.process'), []);

        // Assert the response has validation errors
        $response->assertStatus(422)
            ->assertJson([
                'success' => false,
                'errors' => [
                    'file' => [
                        // The validation error message for required file
                    ],
                ],
            ]);
    }
}
