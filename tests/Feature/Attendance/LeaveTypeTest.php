<?php

namespace Tests\Feature\Attendance;

use App\Models\Company;
use App\Models\LeaveType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LeaveTypeTest extends TestCase
{
    use RefreshDatabase;

    protected $company;

    protected function setUp(): void
    {
        parent::setUp();
        
        $this->company = Company::factory()->create();
    }

    #[Test]
    public function can_create_leave_type()
    {
        $response = $this->postJson(route('attendance.leave.type.store'), [
            'name' => 'Annual Leave',
            'code' => 'AL',
            'description' => 'Annual leave for employees',
            'requires_approval' => true,
            'is_paid' => true,
            'default_days_per_year' => 12,
            'is_active' => true,
            'company_id' => $this->company->id,
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('leave_types', [
            'name' => 'Annual Leave',
            'code' => 'AL',
            'company_id' => $this->company->id,
        ]);
    }

    #[Test]
    public function leave_type_code_must_be_unique()
    {
        LeaveType::factory()->create([
            'code' => 'AL',
            'company_id' => $this->company->id,
        ]);

        $response = $this->postJson(route('attendance.leave.type.store'), [
            'name' => 'Sick Leave',
            'code' => 'AL',
            'description' => 'Sick leave for employees',
            'requires_approval' => true,
            'is_paid' => true,
            'default_days_per_year' => 10,
            'is_active' => true,
            'company_id' => $this->company->id,
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['code']);
    }

    #[Test]
    public function can_update_leave_type()
    {
        $leaveType = LeaveType::factory()->create([
            'name' => 'Annual Leave',
            'company_id' => $this->company->id,
        ]);

        $response = $this->putJson(route('attendance.leave.type.update', $leaveType), [
            'name' => 'Annual Leave (Updated)',
            'code' => 'AL',
            'description' => 'Updated description',
            'requires_approval' => false,
            'is_paid' => true,
            'default_days_per_year' => 15,
            'is_active' => true,
            'company_id' => $this->company->id,
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('leave_types', [
            'id' => $leaveType->id,
            'name' => 'Annual Leave (Updated)',
            'default_days_per_year' => 15,
        ]);
    }

    #[Test]
    public function cannot_delete_leave_type_with_leave_requests()
    {
        $leaveType = LeaveType::factory()->create([
            'company_id' => $this->company->id,
        ]);

        // Simulate a leave request
        $leaveType->leaveRequests()->create([
            'employee_code' => 1,
            'start_date' => now(),
            'end_date' => now()->addDays(1),
            'status' => 'pending',
        ]);

        $response = $this->deleteJson(route('attendance.leave.type.destroy', $leaveType));

        $response->assertStatus(422);
        $response->assertJson(['message' => 'Cannot delete leave type with existing leave requests']);
    }

    #[Test]
    public function cannot_delete_leave_type_with_leave_balances()
    {
        $leaveType = LeaveType::factory()->create([
            'company_id' => $this->company->id,
        ]);

        // Simulate a leave balance
        $leaveType->leaveBalances()->create([
            'employee_code' => 1,
            'balance' => 10,
        ]);

        $response = $this->deleteJson(route('attendance.leave.type.destroy', $leaveType));

        $response->assertStatus(422);
        $response->assertJson(['message' => 'Cannot delete leave type with existing leave balances']);
    }

    #[Test]
    public function can_filter_leave_types()
    {
        // Create some test data
        LeaveType::factory()->create([
            'name' => 'Annual Leave',
            'company_id' => $this->company->id,
        ]);

        LeaveType::factory()->create([
            'name' => 'Sick Leave',
            'company_id' => $this->company->id,
        ]);

        // Test filtering by name
        $response = $this->getJson(route('attendance.leave.type.index', ['search' => 'Annual']));
        $response->assertStatus(200);
        $response->assertJsonCount(1, 'data');

        // Test filtering by company
        $response = $this->getJson(route('attendance.leave.type.index', ['company_id' => $this->company->id]));
        $response->assertStatus(200);
        $response->assertJsonCount(2, 'data');
    }
}
