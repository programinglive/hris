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
        $this->user = User::factory()->create([
            'company_id' => $this->company->id,
        ]);
    }

    #[Test]
    public function employee_can_be_assigned_multiple_work_schedules()
    {
        $this->actingAs($this->user);

        // Assign work schedules
        $this->user->workSchedules()->attach([$this->schedule1->id, $this->schedule2->id]);

        // Verify assignments
        $this->assertTrue($this->user->workSchedules()->where('id', $this->schedule1->id)->exists());
        $this->assertTrue($this->user->workSchedules()->where('id', $this->schedule2->id)->exists());
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

        // Try to assign schedule from different company
        $this->expectException(\Illuminate\Database\QueryException::class);
        $this->user->workSchedules()->attach($otherSchedule->id);
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
        $this->assertFalse($this->user->workSchedules()->where('id', $this->schedule1->id)->exists());
    }

    #[Test]
    public function work_schedule_validation_rules_are_enforced()
    {
        $this->actingAs($this->user);

        // Try to assign invalid schedule
        $response = $this->postJson(route('employee.work-schedule.store'), [
            'user_id' => $this->user->id,
            'schedule_id' => 999999, // Non-existent schedule
        ]);

        $response->assertStatus(422)
            ->assertJsonPath('errors.schedule_id', [
                'The selected schedule_id is invalid.',
            ]);
    }
}
