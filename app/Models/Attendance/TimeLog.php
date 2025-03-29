<?php

namespace App\Models\Attendance;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class TimeLog extends Model
{
    use HasFactory;

    protected $table = 'time_logs';

    protected $fillable = [
        'user_id',
        'log_date',
        'check_in_time',
        'check_out_time',
        'status',
        'notes',
    ];

    protected $casts = [
        'log_date' => 'date',
        'check_in_time' => 'datetime',
        'check_out_time' => 'datetime',
    ];

    /**
     * Get the user that owns the time log.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
