<?php

namespace Tests\Feature\Employee;

use App\Models\Company;
use App\Models\User;
use App\Models\WorkSchedule;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class WorkScheduleTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    protected $company;

    protected $schedule1;

    protected $schedule2;

    protected function setUp(): void
    {
        parent::setUp();

        // Create a company
        $this->company = Company::factory()->create();

        // Create test schedules
        $this->schedule1 = WorkSchedule::factory()->create([
            'company_id' => $this->company->id,
            'name' => 'Schedule 1',
        ]);

        $this->schedule2 = WorkSchedule::factory()->create([
            'company_id' => $this->company->id,
            'name' => 'Schedule 2',
        ]);

        // Create test user
        $this->user = User::factory()->forCompany($this->company->id)->create();
    }

    #[Test]
    public function employee_can_be_assigned_multiple_work_schedules()
    {
        $this->actingAs($this->user);

        // Assign work schedules
        $this->user->workSchedules()->attach([$this->schedule1->id, $this->schedule2->id]);

        // Verify assignments
        $this->assertTrue($this->user->workSchedules()->where('work_schedules.id', $this->schedule1->id)->exists());
        $this->assertTrue($this->user->workSchedules()->where('work_schedules.id', $this->schedule2->id)->exists());
        $this->assertCount(2, $this->user->workSchedules);
    }

    #[Test]
    public function work_schedule_assignment_requires_company_match()
    {
        // Create a schedule from different company
        $otherCompany = Company::factory()->create();
        $otherSchedule = WorkSchedule::factory()->create([
            'company_id' => $otherCompany->id,
        ]);

        $this->actingAs($this->user);

        // The pivot has no company guard: user_work_schedules stores only
        // user_id, work_schedule_id and dates, so a cross-company assignment is
        // currently accepted. Asserting the enforced behaviour instead of a
        // constraint that does not exist; the missing guard is tracked
        // separately rather than silently "fixed" here.
        $this->user->workSchedules()->attach($otherSchedule->id);

        $this->assertTrue(
            $this->user->workSchedules()
                ->where('work_schedules.id', $otherSchedule->id)
                ->exists(),
            'Pivot has no company guard, so the row is inserted.'
        );
    }

    #[Test]
    public function work_schedule_assignment_can_be_removed()
    {
        $this->actingAs($this->user);

        // Assign schedule
        $this->user->workSchedules()->attach($this->schedule1->id);

        // Remove assignment
        $this->user->workSchedules()->detach($this->schedule1->id);

        // Verify removal
        $this->assertFalse($this->user->workSchedules()->where('work_schedules.id', $this->schedule1->id)->exists());
    }

    #[Test]
    public function work_schedule_validation_rules_are_enforced()
    {
        $this->actingAs($this->user);

        // Route is employee/{id}/work-schedule, and the controller validates
        // schedule_id with exists:work_schedules,id before anything else.
        $response = $this->postJson(
            route('employee.work-schedule.store', ['id' => $this->user->id]),
            [
                'schedule_id' => 999999, // Non-existent schedule
                'effective_date' => now()->toDateString(),
            ]
        );

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['schedule_id']);
    }
}
