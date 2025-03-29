<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WorkingShift extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'code',
        'start_time',
        'end_time',
        'break_duration',
        'description',
        'is_active',
        'company_id',
        'working_days',
        'is_default',
        'grace_period_minutes',
    ];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
        'break_duration' => 'integer',
        'is_active' => 'boolean',
        'working_days' => 'array',
        'is_default' => 'boolean',
        'grace_period_minutes' => 'integer',
    ];

    /**
     * Get the company that owns the working shift.
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * Get the employees assigned to this working shift.
     */
    public function employees()
    {
        return $this->hasMany(User::class, 'working_shift_id');
    }

    /**
     * Calculate the total working hours for this shift.
     *
     * @return float
     */
    public function getTotalWorkingHoursAttribute()
    {
        $start = $this->start_time->copy();
        $end = $this->end_time->copy();
        
        // If end time is earlier than start time, it means the shift spans across midnight
        if ($end->lt($start)) {
            $end->addDay();
        }
        
        // Calculate total minutes and subtract break duration
        $totalMinutes = $end->diffInMinutes($start) - $this->break_duration;
        
        // Convert to hours with 2 decimal places
        return round($totalMinutes / 60, 2);
    }

    /**
     * Format the time for display.
     *
     * @param string $time
     * @return string
     */
    public function formatTime($time)
    {
        return date('H:i', strtotime($time));
    }

    /**
     * Get the start time formatted for display.
     *
     * @return string
     */
    public function getFormattedStartTimeAttribute()
    {
        return $this->formatTime($this->start_time);
    }

    /**
     * Get the end time formatted for display.
     *
     * @return string
     */
    public function getFormattedEndTimeAttribute()
    {
        return $this->formatTime($this->end_time);
    }
}
