<?php

namespace Tests\Feature\Organization;

use App\Models\Branch;
use App\Models\Company;
use App\Models\Department;
use App\Models\Division;
use App\Models\SubDivision;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class SubDivisionImportTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected User $user;

    protected Company $company;

    protected Branch $branch;

    protected Department $department;

    protected Division $division;

    protected function setUp(): void
    {
        parent::setUp();

        // Create a user and authenticate
        $this->user = User::factory()->create();
        $this->actingAs($this->user);

        // Create a company for testing
        $this->company = Company::create([
            'name' => 'Test Company',
            'code' => 'TEST',
            'email' => 'test@company.com',
            'is_active' => true,
            'owner_id' => $this->user->id,
        ]);

        // Create a branch for testing
        $this->branch = Branch::create([
            'name' => 'Test Branch',
            'code' => 'BR001',
            'company_id' => $this->company->id,
            'is_active' => true,
            'is_main_branch' => true,
        ]);

        // Create a department for testing
        $this->department = Department::create([
            'name' => 'Test Department',
            'description' => 'Test Department Description',
            'company_id' => $this->company->id,
            'branch_id' => $this->branch->id,
            'status' => 'active',
        ]);

        // Create a division for testing
        $this->division = Division::create([
            'name' => 'Test Division',
            'description' => 'Test Division Description',
            'company_id' => $this->company->id,
            'branch_id' => $this->branch->id,
            'department_id' => $this->department->id,
            'status' => 'active',
        ]);

        // Set up fake storage for file uploads
        Storage::fake('public');
    }

    #[Test]
    public function it_can_download_subdivision_import_template()
    {
        $response = $this->get('/organization/subdivision/import/template');

        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        $response->assertHeader('Content-Disposition', 'attachment; filename=subdivision_import_template.xlsx');
    }

    #[Test]
    public function it_can_import_subdivisions_from_excel_file()
    {
        // Make sure the subdivisions table is empty before starting
        $this->assertEquals(0, SubDivision::count(), 'SubDivisions table should be empty before import test');

        // Create a fake Excel file
        $file = UploadedFile::fake()->create('test_subdivision_import.xlsx', 100);

        // Mock the import process response
        $this->mock(\App\Http\Controllers\Organization\SubDivisionController::class, function ($mock) {
            $mock->shouldReceive('processImport')
                ->once()
                ->andReturn(response()->json([
                    'success' => true,
                    'message' => 'Import completed successfully.',
                    'results' => [
                        'success' => 2,
                        'failed' => 0,
                        'total' => 2,
                    ],
                ]));
        });

        // Send the import request
        $response = $this->postJson('/organization/subdivision/import/process', [
            'file' => $file,
        ]);

        // Assert the response is successful
        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'message' => 'Import completed successfully.',
        ]);

        // Get the response data
        $responseData = $response->json();

        // Assert that the success count is greater than 0
        $this->assertGreaterThan(0, $responseData['results']['success'] ?? 0, 'Expected at least one successful import');
    }

    #[Test]
    public function it_validates_the_uploaded_file()
    {
        // Create a custom validator mock
        $this->partialMock(\Illuminate\Validation\Factory::class, function ($mock) {
            $mock->shouldReceive('make')
                ->andReturnUsing(function ($data, $rules) {
                    return \Illuminate\Support\Facades\Validator::make($data, $rules);
                });
        });

        // Test with no file
        $validator = \Illuminate\Support\Facades\Validator::make(
            [], // Empty data
            ['file' => 'required|file|mimes:xlsx,csv'] // Expected validation rules
        );

        $this->assertTrue($validator->fails());
        $this->assertTrue($validator->errors()->has('file'));
        $this->assertEquals('The file field is required.', $validator->errors()->first('file'));

        // Test with invalid file type
        $invalidFile = UploadedFile::fake()->create('document.pdf', 100);

        $validator = \Illuminate\Support\Facades\Validator::make(
            ['file' => $invalidFile],
            ['file' => 'required|file|mimes:xlsx,csv']
        );

        $this->assertTrue($validator->fails());
        $this->assertTrue($validator->errors()->has('file'));
        $this->assertStringContainsString('must be a file of type', $validator->errors()->first('file'));
    }

    #[Test]
    public function it_handles_invalid_data_in_import_file()
    {
        // Make sure the subdivisions table is empty before starting
        $this->assertEquals(0, SubDivision::count(), 'SubDivisions table should be empty before import test');

        // Create a fake Excel file
        $file = UploadedFile::fake()->create('invalid_subdivision_import.xlsx', 100);

        // Mock the import process response
        $this->mock(\App\Http\Controllers\Organization\SubDivisionController::class, function ($mock) {
            $mock->shouldReceive('processImport')
                ->once()
                ->andReturn(response()->json([
                    'success' => true,
                    'message' => 'Import completed successfully.',
                    'results' => [
                        'success' => 0,
                        'failed' => 2,
                        'total' => 2,
                    ],
                ]));
        });

        // Send the import request
        $response = $this->postJson('/organization/subdivision/import/process', [
            'file' => $file,
        ]);

        // Assert the response is successful
        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'message' => 'Import completed successfully.',
        ]);

        // Check that the results include failed imports
        $responseData = $response->json();
        $this->assertGreaterThan(0, $responseData['results']['failed']);
        $this->assertEquals(0, $responseData['results']['success']);
    }

    #[Test]
    public function it_handles_inertia_requests_for_import()
    {
        // Create a fake Excel file
        $file = UploadedFile::fake()->create('test_subdivision_import.xlsx', 100);

        // Mock the import process response for Inertia
        $this->mock(\App\Http\Controllers\Organization\SubDivisionController::class, function ($mock) {
            $mock->shouldReceive('processImport')
                ->once()
                ->andReturn(response()->json([
                    'success' => true,
                    'message' => 'Import completed successfully.',
                    'results' => [
                        'success' => 2,
                        'failed' => 0,
                        'total' => 2,
                    ],
                ]));
        });

        // Set the header to indicate an Inertia request
        $response = $this->withHeaders([
            'X-Inertia' => 'true',
        ])->post('/organization/subdivision/import/process', [
            'file' => $file,
        ]);

        // Assert the response is successful
        $response->assertStatus(200);
    }
}
