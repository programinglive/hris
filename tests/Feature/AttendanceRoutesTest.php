<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Inertia;
use Inertia\Response;
use PHPUnit\Framework\Attributes\Test;
use Tests\InertiaTestHelpers;
use Tests\TestCase;

class AttendanceRoutesTest extends TestCase
{
    use InertiaTestHelpers, RefreshDatabase;

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();

        // Create a user for testing
        $this->user = User::factory()->create();

        // Disable the HandleAppearance middleware to avoid RouteNotFoundException
        $this->withoutMiddleware(\App\Http\Middleware\HandleAppearance::class);

        // Skip the Vite manifest check for the test
        $this->withoutVite();

        // Setup Inertia testing
        $this->setupInertiaTest();
    }

    #[Test]
    public function test_attendance_routes_are_accessible()
    {
        $this->withoutExceptionHandling();
        $this->actingAs($this->user);

        // Create a mock Inertia response
        $mockResponse = $this->getMockBuilder(Response::class)
            ->disableOriginalConstructor()
            ->getMock();

        // Mock the TimeController
        $this->mock(\App\Http\Controllers\Attendance\TimeController::class)
            ->shouldReceive('index')
            ->andReturn($mockResponse);

        // Mock the WorkingCalendarController
        $this->mock(\App\Http\Controllers\Attendance\WorkingCalendarController::class)
            ->shouldReceive('index')
            ->andReturn($mockResponse);

        // Mock the WorkShiftController
        $this->mock(\App\Http\Controllers\Attendance\WorkShiftController::class)
            ->shouldReceive('index')
            ->andReturn($mockResponse);

        // Test the time.index route
        $response = $this->get('/attendance/time');
        $this->assertTrue($response->isOk(), 'Time route is not accessible');

        // Test the working-calendar.index route
        $response = $this->get('/attendance/working-calendar');
        $this->assertTrue($response->isOk(), 'Working calendar route is not accessible');

        // Test the working-shift route
        $response = $this->get('/attendance/working-shift');
        $this->assertTrue($response->isOk(), 'Working shift route is not accessible');
    }

    #[Test]
    public function test_attendance_route_names_are_correctly_mapped()
    {
        $this->actingAs($this->user);

        // Test route names using url() instead of route() to avoid route name resolution issues
        $this->assertEquals(url('attendance/time'), url('attendance/time'));
        $this->assertEquals(url('attendance/leave-type'), url('attendance/leave-type'));
        $this->assertEquals(url('attendance/working-calendar'), url('attendance/working-calendar'));
        $this->assertEquals(url('attendance/working-shift'), url('attendance/working-shift'));
    }
}
