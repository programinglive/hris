<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Position extends Model
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
        'level_id',
        'sub_division_id',
        'company_id',
        'min_salary',
        'max_salary',
        'status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'min_salary' => 'decimal:2',
        'max_salary' => 'decimal:2',
        'status' => 'string',
    ];

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($position) {
            if (empty($position->code)) {
                $baseCode = Str::upper(Str::substr(Str::slug($position->name), 0, 3));
                $counter = 1;
                $code = $baseCode . '-' . sprintf('%03d', $counter);
                
                // Make sure the code is unique
                while (static::where('code', $code)->exists()) {
                    $counter++;
                    $code = $baseCode . '-' . sprintf('%03d', $counter);
                }
                
                $position->code = $code;
            }
        });
    }

    /**
     * Get the level that owns the position.
     */
    public function level(): BelongsTo
    {
        return $this->belongsTo(Level::class);
    }

    /**
     * Get the sub-division that owns the position.
     */
    public function subDivision(): BelongsTo
    {
        return $this->belongsTo(SubDivision::class);
    }

    /**
     * Get the company that owns the position.
     */
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * Get the employees with this position.
     */
    public function employees(): HasMany
    {
        return $this->hasMany(UserDetail::class, 'position_id');
    }

    /**
     * Get the full position name including level.
     */
    public function getFullNameAttribute(): string
    {
        if ($this->level) {
            return $this->level->name . ' ' . $this->name;
        }
        
        return $this->name;
    }
}
