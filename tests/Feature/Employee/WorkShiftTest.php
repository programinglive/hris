<?php

namespace Tests\Feature\Employee;

use App\Models\Company;
use App\Models\User;
use App\Models\WorkShift;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class WorkShiftTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    protected $company;

    protected $shift1;

    protected $shift2;

    protected function setUp(): void
    {
        parent::setUp();

        // Create a company
        $this->company = Company::factory()->create();

        // Create test shifts
        $this->shift1 = WorkShift::factory()->create([
            'company_id' => $this->company->id,
            'name' => 'Shift 1',
        ]);

        $this->shift2 = WorkShift::factory()->create([
            'company_id' => $this->company->id,
            'name' => 'Shift 2',
        ]);

        // Create test user
        $this->user = User::factory()->create([
            'company_id' => $this->company->id,
        ]);
    }

    #[Test]
    public function employee_can_be_assigned_work_shift()
    {
        $this->actingAs($this->user);

        // Assign work shift
        $this->user->workShifts()->attach($this->shift1->id, ['date' => now()->toDateString()]);

        // Verify assignment
        $this->assertTrue($this->user->workShifts()->where('work_shifts.id', $this->shift1->id)->exists());
        $this->assertCount(1, $this->user->workShifts);
    }

    #[Test]
    public function employee_can_only_have_one_work_shift_per_day()
    {
        $this->actingAs($this->user);

        // Try to assign two shifts on the same day
        $this->expectException(\Illuminate\Database\QueryException::class);

        $this->user->workShifts()->attach([
            $this->shift1->id => ['date' => now()->toDateString()],
            $this->shift2->id => ['date' => now()->toDateString()],
        ]);
    }

    #[Test]
    public function work_shift_assignment_requires_company_match()
    {
        // Create a shift from different company
        $otherCompany = Company::factory()->create();
        $otherShift = WorkShift::factory()->create([
            'company_id' => $otherCompany->id,
        ]);

        $this->actingAs($this->user);

        // Try to assign shift from different company
        $this->expectException(\Illuminate\Database\QueryException::class);
        $this->user->workShifts()->attach($otherShift->id);
    }

    #[Test]
    public function work_shift_assignment_can_be_removed()
    {
        $this->actingAs($this->user);

        // Assign shift
        $this->user->workShifts()->attach($this->shift1->id, ['date' => now()->toDateString()]);

        // Remove assignment
        $this->user->workShifts()->detach($this->shift1->id);

        // Verify removal
        $this->assertFalse($this->user->workShifts()->where('work_shifts.id', $this->shift1->id)->exists());
    }

    #[Test]
    public function work_shift_validation_rules_are_enforced()
    {
        $this->actingAs($this->user);

        // Try to assign shift without date
        $response = $this->post(route('employee.work-shift.store', ['user' => $this->user->id]), [
            'shift_id' => $this->shift1->id,
        ]);

        $response->assertSessionHasErrors(['date']);
    }
}
