<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use App\Models\User;
use App\Models\UserDetail;
use Spatie\SimpleExcel\SimpleExcelReader;

class EmployeeImportTest extends TestCase
{
    use RefreshDatabase;

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

        // Create an uploaded file from the existing template
        $templatePath = storage_path('app/public/templates/employee_import_template.xlsx');
        
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
            'employee_id' => 'EMP001',
            'status' => 'Active',
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
                     'errors' => ['file']
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
                         ]
                     ]
                 ]);
    }
}
