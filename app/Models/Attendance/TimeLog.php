<?php

namespace App\Models\Attendance;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TimeLog extends Model
{
    protected $table = 'time_logs';

    protected $fillable = [
        'user_id',
        'log_date',
        'check_in_time',
        'check_out_time',
        'notes',
        'status',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'log_date' => 'date',
        'check_in_time' => 'datetime',
        'check_out_time' => 'datetime',
        'status' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
