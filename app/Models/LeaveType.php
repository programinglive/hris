<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class LeaveType extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'code',
        'description',
        'requires_approval',
        'is_paid',
        'default_days_per_year',
        'is_active',
        'company_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'requires_approval' => 'boolean',
        'is_paid' => 'boolean',
        'default_days_per_year' => 'integer',
        'is_active' => 'boolean',
    ];

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($leaveType) {
            // Generate code from name if not provided
            if (empty($leaveType->code)) {
                $leaveType->code = self::generateUniqueCode($leaveType->name);
            }
        });
    }

    /**
     * Generate a unique code from the name.
     */
    public static function generateUniqueCode(string $name): string
    {
        // Convert to uppercase and remove special characters
        $code = strtoupper(preg_replace('/[^a-zA-Z0-9]/', '', $name));

        // Take first 3 characters, or pad if shorter
        $code = substr($code, 0, 3);
        $code = str_pad($code, 3, 'X');

        // Check if code exists and append numbers if needed
        $baseCode = $code;
        $counter = 1;

        while (self::where('code', $code)->exists()) {
            $code = $baseCode.$counter;
            $counter++;
        }

        return $code;
    }

    /**
     * Get the company that owns the leave type.
     */
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * Get the leave requests for this leave type.
     */
    public function leaveRequests(): HasMany
    {
        return $this->hasMany(LeaveRequest::class);
    }

    /**
     * Get the leave balances for this leave type.
     */
    public function leaveBalances(): HasMany
    {
        return $this->hasMany(LeaveBalance::class);
    }
}
