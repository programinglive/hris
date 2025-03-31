<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class WorkSchedule extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'start_time',
        'end_time',
        'grace_period_minutes',
        'working_days',
        'is_default',
        'company_id',
        'is_active',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'start_time' => 'datetime:H:i',
        'end_time' => 'datetime:H:i',
        'grace_period_minutes' => 'integer',
        'working_days' => 'array',
        'is_default' => 'boolean',
        'is_active' => 'boolean',
    ];

    /**
     * Get the company that owns the work schedule.
     */
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * Get the user work schedules for this schedule.
     */
    public function userWorkSchedules(): HasMany
    {
        return $this->hasMany(UserWorkSchedule::class);
    }

    /**
     * Get all users assigned to this work schedule.
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_work_schedules')
            ->withPivot('effective_date', 'end_date', 'is_active')
            ->withTimestamps();
    }

    /**
     * Check if a specific day is a working day.
     *
     * @param  int  $dayOfWeek  0 (Sunday) through 6 (Saturday)
     */
    public function isWorkingDay(int $dayOfWeek): bool
    {
        return in_array($dayOfWeek, $this->working_days ?? []);
    }

    /**
     * Get the expected working hours per day.
     */
    public function getWorkingHoursPerDay(): float
    {
        $startTime = strtotime($this->start_time);
        $endTime = strtotime($this->end_time);

        // Handle schedules that cross midnight
        if ($endTime <= $startTime) {
            $endTime += 24 * 60 * 60; // Add 24 hours
        }

        return round(($endTime - $startTime) / 3600, 2);
    }
}
