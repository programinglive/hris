<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class UserDetail extends Model
{
    use HasFactory, LogsActivity, SoftDeletes;

    public $guarded = ['id'];

    protected $casts = [
        'date_of_birth' => 'datetime:Y-m-d',
    ];

    /**
     * Get the user that owns the user detail.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the company that owns the user detail.
     */
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * Get the branch that owns the user detail.
     */
    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    /**
     * Get the department that owns the user detail.
     */
    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    /**
     * Get the division that owns the user detail.
     */
    public function division(): BelongsTo
    {
        return $this->belongsTo(Division::class);
    }

    /**
     * Get the subdivision that owns the user detail.
     */
    public function subDivision(): BelongsTo
    {
        return $this->belongsTo(SubDivision::class);
    }

    /**
     * Get the level that owns the user detail.
     */
    public function level(): BelongsTo
    {
        return $this->belongsTo(Level::class);
    }

    /**
     * Get the position that owns the user detail.
     */
    public function position(): BelongsTo
    {
        return $this->belongsTo(Position::class);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('User Detail');
    }
}
