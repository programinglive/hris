<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class SubDivision extends Model
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
        'division_id',
        'manager_id',
        'status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'status' => 'string',
    ];

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($subDivision) {
            if (empty($subDivision->code)) {
                $baseCode = Str::upper(Str::substr(Str::slug($subDivision->name), 0, 3));
                $counter = 1;
                $code = $baseCode . '-' . sprintf('%03d', $counter);
                
                // Make sure the code is unique
                while (static::where('code', $code)->exists()) {
                    $counter++;
                    $code = $baseCode . '-' . sprintf('%03d', $counter);
                }
                
                $subDivision->code = $code;
            }
        });
    }

    /**
     * Get the division that owns the sub-division.
     */
    public function division(): BelongsTo
    {
        return $this->belongsTo(Division::class);
    }

    /**
     * Get the manager of the sub-division.
     */
    public function manager(): BelongsTo
    {
        return $this->belongsTo(User::class, 'manager_id');
    }

    /**
     * Get the positions for the sub-division.
     */
    public function positions(): HasMany
    {
        return $this->hasMany(Position::class);
    }

    /**
     * Get the employees in the sub-division.
     */
    public function employees(): HasMany
    {
        return $this->hasMany(UserDetail::class, 'sub_division_id');
    }

    /**
     * Get the department through the division.
     */
    public function department(): BelongsTo
    {
        return $this->division->department();
    }
}
