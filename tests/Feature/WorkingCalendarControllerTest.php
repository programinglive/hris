<?php

namespace Tests\Feature;

use App\Models\Company;
use App\Models\Role;
use App\Models\User;
use App\Models\UserDetail;
use App\Models\WorkingCalendar;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class WorkingCalendarControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    protected $company;

    protected function setUp(): void
    {
        parent::setUp();

        // Create a test company first
        $this->company = Company::factory()->create();

        // Create a role with company_id
        $role = Role::create([
            'name' => 'admin',
            'display_name' => 'Administrator',
            'slug' => 'admin',
            'company_id' => $this->company->id,
        ]);

        // Create a test user with company_id
        $this->user = User::factory()->create([
            'company_id' => $this->company->id,
        ]);

        // Assign role to user
        $this->user->roles()->attach($role);

        // Create user details
        UserDetail::create([
            'user_id' => $this->user->id,
            'employee_code' => 'EMP001',
            'join_date' => now()->subYear(),
            'status' => 'active',
            'company_id' => $this->company->id,
        ]);
    }

    #[Test]
    public function it_can_display_working_calendar_index_page()
    {
        $response = $this->actingAs($this->user)
            ->get(route('attendance.working-calendar.index'));

        $response->assertStatus(200);
        $response->assertInertia(fn ($page) => $page
            ->component('attendance/working-calendar/index')
            ->has('workingCalendars')
            ->has('holidays')
        );
    }

    #[Test]
    public function it_can_display_create_working_calendar_page()
    {
        $response = $this->actingAs($this->user)
            ->get(route('attendance.working-calendar.create'));

        $response->assertStatus(200);
        $response->assertInertia(fn ($page) => $page
            ->component('attendance/working-calendar/create')
        );
    }

    #[Test]
    public function it_can_create_a_working_calendar()
    {
        $this->actingAs($this->user);

        $data = [
            'name' => 'Test Working Calendar',
            'start_date' => '2025-01-01',
            'end_date' => '2025-12-31',
            'description' => 'Test description',
            'is_active' => true,
            'company_id' => $this->company->id,
        ];

        $response = $this->post(route('attendance.working-calendar.store'), $data);

        $response->assertRedirect(route('attendance.working-calendar.index'));
        $this->assertDatabaseHas('working_calendars', [
            'name' => 'Test Working Calendar',
            'company_id' => $this->company->id,
        ]);
    }

    #[Test]
    public function it_can_display_edit_working_calendar_page()
    {
        $workingCalendar = WorkingCalendar::factory()->create([
            'company_id' => $this->company->id,
        ]);

        $response = $this->actingAs($this->user)
            ->get(route('attendance.working-calendar.edit', $workingCalendar->id));

        $response->assertStatus(200);
        $response->assertInertia(fn ($page) => $page
            ->component('attendance/working-calendar/edit')
            ->has('workingCalendar')
        );
    }

    #[Test]
    public function it_can_update_a_working_calendar()
    {
        $workingCalendar = WorkingCalendar::factory()->create([
            'company_id' => $this->company->id,
        ]);

        $data = [
            'name' => 'Updated Working Calendar',
            'start_date' => '2025-02-01',
            'end_date' => '2025-11-30',
            'description' => 'Updated description',
            'is_active' => false,
            'company_id' => $this->company->id,
        ];

        $response = $this->actingAs($this->user)
            ->put(route('attendance.working-calendar.update', $workingCalendar->id), $data);

        $response->assertRedirect(route('attendance.working-calendar.index'));
        $this->assertDatabaseHas('working_calendars', [
            'id' => $workingCalendar->id,
            'name' => 'Updated Working Calendar',
            'description' => 'Updated description',
            'is_active' => 0,
            'company_id' => $this->company->id,
        ]);
    }

    #[Test]
    public function it_can_display_show_working_calendar_page()
    {
        $workingCalendar = WorkingCalendar::factory()->create([
            'company_id' => $this->company->id,
        ]);

        $response = $this->actingAs($this->user)
            ->get(route('attendance.working-calendar.show', $workingCalendar->id));

        $response->assertStatus(200);
        $response->assertInertia(fn ($page) => $page
            ->component('attendance/working-calendar/show')
            ->has('workingCalendar')
            ->has('holidays')
        );
    }

    #[Test]
    public function it_can_delete_a_working_calendar()
    {
        $workingCalendar = WorkingCalendar::factory()->create([
            'company_id' => $this->company->id,
        ]);

        $response = $this->actingAs($this->user)
            ->delete(route('attendance.working-calendar.destroy', $workingCalendar->id));

        $response->assertRedirect(route('attendance.working-calendar.index'));
        $this->assertDatabaseMissing('working_calendars', [
            'id' => $workingCalendar->id,
        ]);
    }
}
