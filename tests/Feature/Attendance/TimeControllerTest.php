<?php

namespace Tests\Feature\Attendance;

use App\Models\Attendance\TimeLog;
use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class TimeControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('password'),
        ]);

        UserDetail::create([
            'user_id' => $this->user->id,
            'employee_code' => 'EMP001',
            'join_date' => now()->subYear(),
            'status' => 'active',
        ]);
    }

    #[Test]
    public function time_index_page_displays_time_logs()
    {
        $this->actingAs($this->user);

        $response = $this->get(route('attendance.time.index'));

        $response->assertStatus(200)
            ->assertInertia(fn (Assert $page) => $page->component('attendance/time/index')
            );
    }

    #[Test]
    public function can_create_time_log()
    {
        $this->actingAs($this->user);

        $response = $this->post(route('attendance.time.store'), [
            'user_id' => $this->user->id,
            'check_in' => now(),
            'check_out' => now()->addHours(8),
            'notes' => 'Working from office',
        ]);

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'message' => 'Time log created successfully',
            ]);

        $this->assertDatabaseHas('time_logs', [
            'user_id' => $this->user->id,
            'notes' => 'Working from office',
        ]);
    }

    #[Test]
    public function can_update_time_log()
    {
        $this->actingAs($this->user);

        // Create a time log first
        $timeLog = TimeLog::factory()->create([
            'user_id' => $this->user->id,
        ]);

        $response = $this->put(route('attendance.time.update', $timeLog->id), [
            'check_out' => now()->addHours(9),
            'notes' => 'Updated notes',
        ]);

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'message' => 'Time log updated successfully',
            ]);

        $this->assertDatabaseHas('time_logs', [
            'id' => $timeLog->id,
            'notes' => 'Updated notes',
        ]);
    }

    #[Test]
    public function can_delete_time_log()
    {
        $this->actingAs($this->user);

        // Create a time log first
        $timeLog = TimeLog::factory()->create([
            'user_id' => $this->user->id,
        ]);

        $response = $this->delete(route('attendance.time.destroy', $timeLog->id));

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'message' => 'Time log deleted successfully',
            ]);

        $this->assertDatabaseMissing('time_logs', [
            'id' => $timeLog->id,
        ]);
    }

    #[Test]
    public function can_filter_time_logs()
    {
        $this->actingAs($this->user);

        // Create some time logs
        TimeLog::factory(3)->create([
            'user_id' => $this->user->id,
            'check_in' => now()->subDays(1),
        ]);

        TimeLog::factory(2)->create([
            'user_id' => $this->user->id,
            'check_in' => now(),
        ]);

        $response = $this->get(route('attendance.time.index', [
            'start_date' => now()->format('Y-m-d'),
            'end_date' => now()->format('Y-m-d'),
        ]));

        $response->assertStatus(200)
            ->assertInertia(fn (Assert $page) => $page->component('attendance/time/index')
                ->has('timeLogs', 2)
            );
    }
}
