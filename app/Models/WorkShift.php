<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class WorkShift extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'start_time',
        'end_time',
        'code',
        'company_id',
        'is_active',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_active' => 'boolean',
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($shift) {
            if (empty($shift->code)) {
                $shift->code = 'WSH'.str_pad($shift->id ?? 1, 4, '0', STR_PAD_LEFT);
            }
        });
    }

    /**
     * Get the company that owns the work shift.
     */
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * Get all of the users that are assigned to the work shift.
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_work_shifts')
            ->using(UserWorkShift::class)
            ->withPivot([
                'date',
                'created_at',
                'updated_at',
            ])
            ->withTimestamps();
    }
}
