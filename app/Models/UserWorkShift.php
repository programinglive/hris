<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class UserWorkShift extends Pivot
{
    protected $table = 'user_work_shifts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'work_shift_id',
        'date'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'date' => 'date',
    ];

    /**
     * Get the user that the work shift is assigned to.
     */
    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    /**
     * Get the work shift that is assigned to the user.
     */
    public function workShift(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\WorkShift::class);
    }
}
