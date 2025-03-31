<?php

namespace Tests\Unit;

use App\Models\Company;
use App\Models\WorkingCalendar;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class WorkingCalendarTest extends TestCase
{
    use RefreshDatabase;

    protected $company;

    protected function setUp(): void
    {
        parent::setUp();

        // Create a test company without using factory to avoid dependencies
        $this->company = new Company([
            'name' => 'Test Company',
            'address' => 'Test Address',
            'phone' => '1234567890',
            'email' => 'test@company.com',
            'website' => 'https://testcompany.com',
        ]);
        $this->company->save();
    }

    #[Test]
    public function it_can_create_a_working_calendar()
    {
        $workingCalendar = new WorkingCalendar([
            'name' => 'Test Working Calendar',
            'start_date' => '2025-01-01',
            'end_date' => '2025-12-31',
            'description' => 'Test description',
            'is_active' => true,
            'company_id' => $this->company->id,
        ]);

        $workingCalendar->save();

        $this->assertDatabaseHas('working_calendars', [
            'name' => 'Test Working Calendar',
            'description' => 'Test description',
            'is_active' => 1,
            'company_id' => $this->company->id,
        ]);
    }

    #[Test]
    public function it_casts_dates_correctly()
    {
        $workingCalendar = new WorkingCalendar([
            'name' => 'Test Working Calendar',
            'start_date' => '2025-01-01',
            'end_date' => '2025-12-31',
            'description' => 'Test description',
            'is_active' => true,
            'company_id' => $this->company->id,
        ]);

        $workingCalendar->save();

        $this->assertInstanceOf(Carbon::class, $workingCalendar->start_date);
        $this->assertInstanceOf(Carbon::class, $workingCalendar->end_date);
        $this->assertEquals('2025-01-01', $workingCalendar->start_date->format('Y-m-d'));
        $this->assertEquals('2025-12-31', $workingCalendar->end_date->format('Y-m-d'));
    }

    #[Test]
    public function it_casts_is_active_to_boolean()
    {
        $workingCalendar = new WorkingCalendar([
            'name' => 'Test Working Calendar',
            'start_date' => '2025-01-01',
            'end_date' => '2025-12-31',
            'description' => 'Test description',
            'is_active' => true,
            'company_id' => $this->company->id,
        ]);

        $workingCalendar->save();

        $this->assertIsBool($workingCalendar->is_active);
        $this->assertTrue($workingCalendar->is_active);
    }

    #[Test]
    public function it_belongs_to_a_company()
    {
        $workingCalendar = new WorkingCalendar([
            'name' => 'Test Working Calendar',
            'start_date' => '2025-01-01',
            'end_date' => '2025-12-31',
            'description' => 'Test description',
            'is_active' => true,
            'company_id' => $this->company->id,
        ]);

        $workingCalendar->save();

        $this->assertInstanceOf(Company::class, $workingCalendar->company);
        $this->assertEquals($this->company->id, $workingCalendar->company->id);
    }

    #[Test]
    public function it_can_check_if_a_date_is_within_the_calendar_period()
    {
        $workingCalendar = new WorkingCalendar([
            'name' => 'Test Working Calendar',
            'start_date' => '2025-01-01',
            'end_date' => '2025-12-31',
            'description' => 'Test description',
            'is_active' => true,
            'company_id' => $this->company->id,
        ]);

        $workingCalendar->save();

        $dateWithin = Carbon::create(2025, 6, 15);
        $dateBefore = Carbon::create(2024, 12, 31);
        $dateAfter = Carbon::create(2026, 1, 1);

        $this->assertTrue($dateWithin >= $workingCalendar->start_date && $dateWithin <= $workingCalendar->end_date);
        $this->assertFalse($dateBefore >= $workingCalendar->start_date && $dateBefore <= $workingCalendar->end_date);
        $this->assertFalse($dateAfter >= $workingCalendar->start_date && $dateAfter <= $workingCalendar->end_date);
    }
}
