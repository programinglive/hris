<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Division extends Model
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
        'department_id',
        'manager_id',
        'is_active',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($division) {
            if (empty($division->code)) {
                $baseCode = Str::upper(Str::substr(Str::slug($division->name), 0, 3));
                $counter = 1;
                $code = $baseCode.'-'.sprintf('%03d', $counter);

                // Make sure the code is unique
                while (static::where('code', $code)->exists()) {
                    $counter++;
                    $code = $baseCode.'-'.sprintf('%03d', $counter);
                }

                $division->code = $code;
            }
        });
    }

    /**
     * Get the department that owns the division.
     */
    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    /**
     * Get the manager of the division.
     */
    public function manager(): BelongsTo
    {
        return $this->belongsTo(User::class, 'manager_id');
    }

    /**
     * Get the sub-divisions for the division.
     */
    public function subDivisions(): HasMany
    {
        return $this->hasMany(SubDivision::class);
    }

    /**
     * Get the positions for the division.
     */
    public function positions(): HasMany
    {
        return $this->hasMany(Position::class);
    }

    /**
     * Get the employees in the division.
     */
    public function employees(): HasMany
    {
        return $this->hasMany(UserDetail::class, 'division_id');
    }
}
