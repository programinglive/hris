<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LeaveRequest extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'leave_type_id',
        'start_date',
        'end_date',
        'total_days',
        'reason',
        'status',
        'approved_by',
        'approved_at',
        'rejection_reason',
        'attachment',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'total_days' => 'integer',
        'approved_at' => 'datetime',
    ];

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($leaveRequest) {
            // Calculate total days if not provided
            if (empty($leaveRequest->total_days) && $leaveRequest->start_date && $leaveRequest->end_date) {
                $leaveRequest->total_days = $leaveRequest->start_date->diffInDays($leaveRequest->end_date) + 1;
            }
        });

        static::updating(function ($leaveRequest) {
            // If status changed to approved, update leave balance
            if ($leaveRequest->isDirty('status') && $leaveRequest->status === 'approved') {
                $leaveRequest->updateLeaveBalance();
            } elseif ($leaveRequest->isDirty('status') && $leaveRequest->status === 'cancelled') {
                $leaveRequest->updateLeaveBalance();
            }
        });
    }

    /**
     * Get the user who made the leave request.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the leave type for this request.
     */
    public function leaveType(): BelongsTo
    {
        return $this->belongsTo(LeaveType::class);
    }

    /**
     * Get the user who approved the leave request.
     */
    public function approver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    /**
     * Update leave balance when request status changes.
     */
    public function updateLeaveBalance(): void
    {
        $leaveBalance = LeaveBalance::where([
            'user_id' => $this->user_id,
            'leave_type_id' => $this->leave_type_id,
            'year' => $this->start_date->year,
        ])->first();

        if ($leaveBalance) {
            if ($this->status === 'approved') {
                $leaveBalance->update([
                    'used_days' => $leaveBalance->used_days + $this->total_days,
                    'remaining_days' => $leaveBalance->total_days - $leaveBalance->used_days,
                ]);
            } elseif ($this->status === 'cancelled') {
                $leaveBalance->update([
                    'used_days' => $leaveBalance->used_days - $this->total_days,
                    'remaining_days' => $leaveBalance->total_days - $leaveBalance->used_days,
                ]);
            }
        }
    }
}
