<?php

namespace Tests\Feature\Attendance;

use App\Models\Company;
use App\Models\User;
use App\Models\UserDetail;
use App\Models\WorkingShift;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use PHPUnit\Framework\Test;

class WorkingShiftTest extends TestCase
{
    use RefreshDatabase;

    protected $user;
    protected $company;

    protected function setUp(): void
    {
        parent::setUp();

        // Create a company
        $this->company = Company::create([
            'name' => 'Test Company',
            'code' => 'TEST-CO',
            'is_active' => true,
        ]);

        // Create a user with admin role
        $this->user = User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ]);

        // Create user details with company association
        UserDetail::create([
            'user_id' => $this->user->id,
            'company_id' => $this->company->id,
            'employee_id' => 'EMP-001',
            'status' => 'active',
        ]);

        // Authenticate the user
        $this->actingAs($this->user);
    }

    #[Test]
    public function it_can_display_working_shift_list_page()
    {
        $response = $this->get(route('attendance.working-shift.index'));
        
        $response->assertStatus(200);
        $response->assertInertia(fn ($assert) => $assert
            ->component('attendance/working-shift/lists')
            ->has('workingShifts')
        );
    }

    #[Test]
    public function it_can_create_a_working_shift()
    {
        $data = [
            'name' => 'Morning Shift',
            'code' => 'SHIFT-MOR',
            'start_time' => '08:00',
            'end_time' => '17:00',
            'break_duration' => 60,
            'description' => 'Standard morning shift with 1-hour lunch break',
            'is_active' => true,
        ];

        $response = $this->post(route('attendance.working-shift.store'), $data);
        
        $response->assertRedirect(route('attendance.working-shift.index'));
        $this->assertDatabaseHas('working_shifts', [
            'name' => 'Morning Shift',
            'code' => 'SHIFT-MOR',
            'company_id' => $this->company->id,
        ]);
    }

    #[Test]
    public function it_can_create_a_working_shift_with_working_days()
    {
        $data = [
            'name' => 'Morning Shift',
            'start_time' => '08:00',
            'end_time' => '17:00',
            'grace_period_minutes' => 15,
            'working_days' => [1, 2, 3, 4, 5], // Monday to Friday
            'is_default' => false,
            'company_id' => $this->company->id,
        ];

        $response = $this->post(route('attendance.working-shift.store'), $data);
        
        $response->assertRedirect(route('attendance.working-shift.index'));
        $this->assertDatabaseHas('working_shifts', [
            'name' => 'Morning Shift',
            'company_id' => $this->company->id,
            'working_days' => [1, 2, 3, 4, 5]
        ]);
    }

    #[Test]
    public function it_can_update_a_working_shift()
    {
        // Create a working shift
        $shift = WorkingShift::create([
            'name' => 'Morning Shift',
            'code' => 'SHIFT-MOR-TEST',
            'start_time' => '08:00',
            'end_time' => '17:00',
            'break_duration' => 60,
            'description' => 'Standard morning shift with 1-hour lunch break',
            'is_active' => true,
            'company_id' => $this->company->id,
        ]);

        $updatedData = [
            'name' => 'Updated Morning Shift',
            'code' => 'SHIFT-MOR-TEST',
            'start_time' => '09:00',
            'end_time' => '18:00',
            'break_duration' => 45,
            'description' => 'Updated morning shift with 45-minute lunch break',
            'is_active' => true,
        ];

        $response = $this->put(route('attendance.working-shift.update', $shift->id), $updatedData);
        
        $response->assertRedirect(route('attendance.working-shift.index'));
        $this->assertDatabaseHas('working_shifts', [
            'id' => $shift->id,
            'name' => 'Updated Morning Shift',
            'break_duration' => 45,
        ]);
        
        // Get the updated shift and check the time values
        $updatedShift = WorkingShift::find($shift->id);
        $this->assertEquals('09:00:00', $updatedShift->start_time->format('H:i:s'));
        $this->assertEquals('18:00:00', $updatedShift->end_time->format('H:i:s'));
    }

    #[Test]
    public function it_can_set_default_working_shift_for_company()
    {
        // Create a working shift
        $shift = WorkingShift::create([
            'name' => 'Morning Shift',
            'start_time' => '08:00',
            'end_time' => '17:00',
            'grace_period_minutes' => 15,
            'working_days' => [1, 2, 3, 4, 5],
            'is_default' => false,
            'company_id' => $this->company->id,
        ]);

        // Update to make it default
        $response = $this->put(route('attendance.working-shift.update', $shift->id), [
            'name' => 'Morning Shift',
            'start_time' => '08:00',
            'end_time' => '17:00',
            'grace_period_minutes' => 15,
            'working_days' => [1, 2, 3, 4, 5],
            'is_default' => true,
            'company_id' => $this->company->id,
        ]);

        $response->assertRedirect(route('attendance.working-shift.index'));
        $this->assertDatabaseHas('working_shifts', [
            'id' => $shift->id,
            'is_default' => true
        ]);

        // Ensure no other shifts are default for this company
        $otherShift = WorkingShift::create([
            'name' => 'Evening Shift',
            'start_time' => '16:00',
            'end_time' => '01:00',
            'grace_period_minutes' => 15,
            'working_days' => [1, 2, 3, 4, 5],
            'is_default' => false,
            'company_id' => $this->company->id,
        ]);

        $this->assertDatabaseHas('working_shifts', [
            'id' => $otherShift->id,
            'is_default' => false
        ]);
    }

    #[Test]
    public function it_can_delete_a_working_shift()
    {
        // Create a working shift
        $shift = WorkingShift::create([
            'name' => 'Morning Shift',
            'code' => 'SHIFT-MOR-TEST',
            'start_time' => '08:00',
            'end_time' => '17:00',
            'break_duration' => 60,
            'description' => 'Standard morning shift with 1-hour lunch break',
            'is_active' => true,
            'company_id' => $this->company->id,
        ]);

        $response = $this->delete(route('attendance.working-shift.destroy', $shift->id));
        
        $response->assertRedirect(route('attendance.working-shift.index'));
        $this->assertSoftDeleted('working_shifts', ['id' => $shift->id]);
    }

    #[Test]
    public function it_validates_required_fields_when_creating_a_working_shift()
    {
        $response = $this->post(route('attendance.working-shift.store'), []);
        
        $response->assertSessionHasErrors(['name', 'code', 'start_time', 'end_time', 'break_duration']);
    }

    #[Test]
    public function it_validates_unique_code_when_creating_a_working_shift()
    {
        // Create a working shift
        WorkingShift::create([
            'name' => 'Morning Shift',
            'code' => 'SHIFT-MOR-TEST',
            'start_time' => '08:00',
            'end_time' => '17:00',
            'break_duration' => 60,
            'description' => 'Standard morning shift with 1-hour lunch break',
            'is_active' => true,
            'company_id' => $this->company->id,
        ]);

        // Try to create another shift with the same code
        $response = $this->post(route('attendance.working-shift.store'), [
            'name' => 'Another Morning Shift',
            'code' => 'SHIFT-MOR-TEST', // Same code as existing shift
            'start_time' => '09:00',
            'end_time' => '18:00',
            'break_duration' => 45,
            'description' => 'Another morning shift',
            'is_active' => true,
        ]);
        
        $response->assertSessionHasErrors(['code']);
    }

    #[Test]
    public function it_validates_working_days_when_creating_a_working_shift()
    {
        $response = $this->post(route('attendance.working-shift.store'), [
            'name' => 'Morning Shift',
            'start_time' => '08:00',
            'end_time' => '17:00',
            'grace_period_minutes' => 15,
            'working_days' => [7], // Invalid day (should be 0-6)
            'is_default' => false,
            'company_id' => $this->company->id,
        ]);

        $response->assertSessionHasErrors(['working_days']);
    }

    #[Test]
    public function it_validates_grace_period_when_creating_a_working_shift()
    {
        $response = $this->post(route('attendance.working-shift.store'), [
            'name' => 'Morning Shift',
            'start_time' => '08:00',
            'end_time' => '17:00',
            'grace_period_minutes' => 75, // Invalid (should be 0-60)
            'working_days' => [1, 2, 3, 4, 5],
            'is_default' => false,
            'company_id' => $this->company->id,
        ]);

        $response->assertSessionHasErrors(['grace_period_minutes']);
    }

    #[Test]
    public function it_prevents_deleting_working_shift_assigned_to_employees()
    {
        // Create a working shift
        $shift = WorkingShift::create([
            'name' => 'Morning Shift',
            'start_time' => '08:00',
            'end_time' => '17:00',
            'grace_period_minutes' => 15,
            'working_days' => [1, 2, 3, 4, 5],
            'is_default' => false,
            'company_id' => $this->company->id,
        ]);

        // Assign shift to an employee
        $this->user->detail()->update(['working_shift_id' => $shift->id]);

        $response = $this->delete(route('attendance.working-shift.destroy', $shift->id));
        
        $response->assertRedirect(route('attendance.working-shift.index'));
        $this->assertDatabaseHas('working_shifts', ['id' => $shift->id]); // Should not be deleted
    }

    #[Test]
    public function it_validates_end_time_after_start_time()
    {
        $response = $this->post(route('attendance.working-shift.store'), [
            'name' => 'Morning Shift',
            'start_time' => '17:00',
            'end_time' => '08:00',
            'grace_period_minutes' => 15,
            'working_days' => [1, 2, 3, 4, 5],
            'is_default' => false,
            'company_id' => $this->company->id,
        ]);

        $response->assertSessionHasErrors(['end_time']);
    }

    #[Test]
    public function it_can_display_working_shift_details()
    {
        // Create a working shift
        $shift = WorkingShift::create([
            'name' => 'Morning Shift',
            'start_time' => '08:00',
            'end_time' => '17:00',
            'grace_period_minutes' => 15,
            'working_days' => [1, 2, 3, 4, 5],
            'is_default' => false,
            'company_id' => $this->company->id,
        ]);

        $response = $this->get(route('attendance.working-shift.show', $shift->id));
        
        $response->assertStatus(200);
        $response->assertInertia(fn ($assert) => $assert
            ->component('attendance/working-shift/show')
            ->has('workShift')
        );
    }
}
