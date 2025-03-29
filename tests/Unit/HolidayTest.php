<?php

namespace Tests\Unit;

use App\Models\Company;
use App\Models\Holiday;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Carbon\Carbon;
use PHPUnit\Framework\Attributes\Test;

class HolidayTest extends TestCase
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
    public function it_can_create_a_holiday()
    {
        $holiday = new Holiday([
            'name' => 'Test Holiday',
            'date' => '2025-01-01',
            'description' => 'Test holiday description',
            'is_recurring' => true,
            'company_id' => $this->company->id,
        ]);
        $holiday->save();

        $this->assertDatabaseHas('holidays', [
            'name' => 'Test Holiday',
            'description' => 'Test holiday description',
            'is_recurring' => 1,
            'company_id' => $this->company->id,
        ]);
    }

    #[Test]
    public function it_casts_date_correctly()
    {
        $holiday = new Holiday([
            'name' => 'Test Holiday',
            'date' => '2025-01-01',
            'description' => 'Test holiday description',
            'is_recurring' => true,
            'company_id' => $this->company->id,
        ]);
        $holiday->save();

        $this->assertInstanceOf(Carbon::class, $holiday->date);
        $this->assertEquals('2025-01-01', $holiday->date->format('Y-m-d'));
    }

    #[Test]
    public function it_casts_is_recurring_to_boolean()
    {
        $holiday = new Holiday([
            'name' => 'Test Holiday',
            'date' => '2025-01-01',
            'description' => 'Test holiday description',
            'is_recurring' => true,
            'company_id' => $this->company->id,
        ]);
        $holiday->save();

        $this->assertIsBool($holiday->is_recurring);
        $this->assertTrue($holiday->is_recurring);
    }

    #[Test]
    public function it_belongs_to_a_company()
    {
        $holiday = new Holiday([
            'name' => 'Test Holiday',
            'date' => '2025-01-01',
            'description' => 'Test holiday description',
            'is_recurring' => true,
            'company_id' => $this->company->id,
        ]);
        $holiday->save();

        $this->assertInstanceOf(Company::class, $holiday->company);
        $this->assertEquals($this->company->id, $holiday->company->id);
    }

    #[Test]
    public function it_can_find_holidays_on_a_specific_date()
    {
        // Create multiple holidays
        $newYear = new Holiday([
            'name' => 'New Year',
            'date' => '2025-01-01',
            'description' => 'New Year celebration',
            'is_recurring' => true,
            'company_id' => $this->company->id,
        ]);
        $newYear->save();

        $christmas = new Holiday([
            'name' => 'Christmas',
            'date' => '2025-12-25',
            'description' => 'Christmas celebration',
            'is_recurring' => true,
            'company_id' => $this->company->id,
        ]);
        $christmas->save();

        // Find holidays on a specific date
        $newYearDate = Carbon::create(2025, 1, 1);
        $christmasDate = Carbon::create(2025, 12, 25);
        $regularDate = Carbon::create(2025, 3, 15);

        $newYearHolidays = Holiday::whereDate('date', $newYearDate)->get();
        $christmasHolidays = Holiday::whereDate('date', $christmasDate)->get();
        $regularDateHolidays = Holiday::whereDate('date', $regularDate)->get();

        $this->assertCount(1, $newYearHolidays);
        $this->assertEquals('New Year', $newYearHolidays->first()->name);
        
        $this->assertCount(1, $christmasHolidays);
        $this->assertEquals('Christmas', $christmasHolidays->first()->name);
        
        $this->assertCount(0, $regularDateHolidays);
    }
}
