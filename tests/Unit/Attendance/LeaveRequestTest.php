<?php

namespace Tests\Unit\Attendance;

use App\Models\Company;
use App\Models\Employee;
use App\Models\LeaveBalance;
use App\Models\LeaveRequest;
use App\Models\LeaveType;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LeaveRequestTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    protected $employee;

    protected $company;

    protected $leaveType;

    protected function setUp(): void
    {
        parent::setUp();

        // Create test data
        $this->company = Company::factory()->create();
        $this->user = User::factory()->create();
        $this->user->userDetails()->create([
            'company_id' => $this->company->id,
        ]);
        $this->employee = Employee::factory()->create([
            'user_id' => $this->user->id,
            'company_id' => $this->company->id,
        ]);
        $this->leaveType = LeaveType::factory()->create([
            'company_id' => $this->company->id,
            'default_days_per_year' => 15,
            'is_paid' => true,
            'requires_approval' => true,
        ]);
    }

    public function it_can_create_a_leave_request()
    {
        $this->actingAs($this->user);

        $startDate = now()->addDay();
        $endDate = $startDate->copy()->addDays(3);

        $leaveBalance = LeaveBalance::factory()->create([
            'user_id' => $this->user->id,
            'leave_type_id' => $this->leaveType->id,
            'total_days' => 15,
            'used_days' => 0,
            'remaining_days' => 15,
        ]);

        $response = $this->post('/attendance/leave', [
            'leave_type_id' => $this->leaveType->id,
            'start_date' => $startDate->format('Y-m-d'),
            'end_date' => $endDate->format('Y-m-d'),
            'reason' => 'Annual leave',
            'status' => 'pending',
        ]);

        $response->assertRedirect('/attendance/leave');

        $this->assertDatabaseHas('leave_requests', [
            'user_id' => $this->user->id,
            'leave_type_id' => $this->leaveType->id,
            'status' => 'pending',
        ]);

        $updatedBalance = LeaveBalance::find($leaveBalance->id);
        $this->assertEquals(0, $updatedBalance->used_days);
        $this->assertEquals(15, $updatedBalance->remaining_days);
    }

    public function it_can_update_a_leave_request()
    {
        $this->actingAs($this->user);

        // Create a leave request
        $leaveRequest = LeaveRequest::factory()->create([
            'user_id' => $this->user->id,
            'leave_type_id' => $this->leaveType->id,
            'status' => 'pending',
        ]);

        $leaveBalance = LeaveBalance::factory()->create([
            'user_id' => $this->user->id,
            'leave_type_id' => $this->leaveType->id,
            'total_days' => 15,
            'used_days' => 0,
            'remaining_days' => 15,
        ]);

        $newStartDate = now()->addDays(5);
        $newEndDate = $newStartDate->copy()->addDays(2);

        $response = $this->put("/attendance/leave/{$leaveRequest->id}", [
            'leave_type_id' => $this->leaveType->id,
            'start_date' => $newStartDate->format('Y-m-d'),
            'end_date' => $newEndDate->format('Y-m-d'),
            'reason' => 'Updated reason',
            'status' => 'approved',
        ]);

        $response->assertRedirect('/attendance/leave');

        $this->assertDatabaseHas('leave_requests', [
            'id' => $leaveRequest->id,
            'status' => 'approved',
            'reason' => 'Updated reason',
        ]);

        $updatedBalance = LeaveBalance::find($leaveBalance->id);
        $this->assertEquals(3, $updatedBalance->used_days);
        $this->assertEquals(12, $updatedBalance->remaining_days);
    }

    public function it_can_view_leave_requests()
    {
        $this->actingAs($this->user);

        // Create some leave requests
        LeaveRequest::factory()->count(3)->create([
            'user_id' => $this->user->id,
            'leave_type_id' => $this->leaveType->id,
        ]);

        $leaveBalance = LeaveBalance::factory()->create([
            'user_id' => $this->user->id,
            'leave_type_id' => $this->leaveType->id,
            'total_days' => 15,
            'used_days' => 0,
            'remaining_days' => 15,
        ]);

        $startDate = now()->addDay();
        $endDate = $startDate->copy()->addDays(3);
        $totalDays = 3;

        LeaveRequest::factory()->create([
            'user_id' => $this->user->id,
            'leave_type_id' => $this->leaveType->id,
            'start_date' => $startDate,
            'end_date' => $endDate,
            'total_days' => $totalDays,
            'reason' => 'Annual leave',
            'status' => 'pending',
        ]);

        $response = $this->get('/attendance/leave');

        $response->assertOk();
        $response->assertViewIs('attendance.leave.index');
        $response->assertViewHas('leaveRequests');
    }

    public function it_checks_leave_balance_before_creating_request()
    {
        $this->actingAs($this->user);

        // Create a leave balance with only 1 day remaining
        $leaveBalance = LeaveBalance::create([
            'user_id' => $this->user->id,
            'leave_type_id' => $this->leaveType->id,
            'year' => now()->year,
            'total_days' => 15,
            'used_days' => 14,
            'remaining_days' => 1,
        ]);

        $startDate = now()->addDay();
        $endDate = $startDate->copy()->addDays(2); // 3 days total

        $response = $this->post('/attendance/leave', [
            'leave_type_id' => $this->leaveType->id,
            'start_date' => $startDate->format('Y-m-d'),
            'end_date' => $endDate->format('Y-m-d'),
            'reason' => 'Annual leave',
            'status' => 'pending',
        ]);

        $response->assertRedirect('/attendance/leave/create');
        $response->assertSessionHasErrors('leave_type_id');

        $updatedBalance = LeaveBalance::find($leaveBalance->id);
        $this->assertEquals(14, $updatedBalance->used_days);
        $this->assertEquals(1, $updatedBalance->remaining_days);
    }

    public function it_updates_leave_balance_when_request_is_approved()
    {
        $this->actingAs($this->user);

        // Create a leave balance with 15 days
        $leaveBalance = LeaveBalance::create([
            'user_id' => $this->user->id,
            'leave_type_id' => $this->leaveType->id,
            'year' => now()->year,
            'total_days' => 15,
            'used_days' => 0,
            'remaining_days' => 15,
        ]);

        $startDate = now()->addDay();
        $endDate = $startDate->copy()->addDays(2); // 3 days total

        $response = $this->post('/attendance/leave', [
            'leave_type_id' => $this->leaveType->id,
            'start_date' => $startDate->format('Y-m-d'),
            'end_date' => $endDate->format('Y-m-d'),
            'reason' => 'Annual leave',
            'status' => 'approved',
        ]);

        $response->assertRedirect('/attendance/leave');

        // Check if leave balance was updated
        $updatedBalance = LeaveBalance::find($leaveBalance->id);
        $this->assertEquals(3, $updatedBalance->used_days);
        $this->assertEquals(12, $updatedBalance->remaining_days);
    }

    public function it_returns_leave_days_when_request_is_cancelled()
    {
        $this->actingAs($this->user);

        // Create a leave balance with 15 days
        $leaveBalance = LeaveBalance::create([
            'user_id' => $this->user->id,
            'leave_type_id' => $this->leaveType->id,
            'year' => now()->year,
            'total_days' => 15,
            'used_days' => 3,
            'remaining_days' => 12,
        ]);

        // Create an approved leave request
        $leaveRequest = LeaveRequest::factory()->create([
            'user_id' => $this->user->id,
            'leave_type_id' => $this->leaveType->id,
            'status' => 'approved',
            'total_days' => 3,
        ]);

        // Cancel the leave request
        $response = $this->put("/attendance/leave/{$leaveRequest->id}", [
            'leave_type_id' => $this->leaveType->id,
            'start_date' => $leaveRequest->start_date,
            'end_date' => $leaveRequest->end_date,
            'reason' => $leaveRequest->reason,
            'status' => 'cancelled',
        ]);

        $response->assertRedirect('/attendance/leave');

        // Check if leave balance was updated
        $updatedBalance = LeaveBalance::find($leaveBalance->id);
        $this->assertEquals(0, $updatedBalance->used_days);
        $this->assertEquals(15, $updatedBalance->remaining_days);
    }
}
