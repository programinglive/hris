<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

class Brand extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'code',
        'logo',
        'description',
        'company_id',
        'branch_id',
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

        static::creating(function ($brand) {
            if (empty($brand->code)) {
                $baseCode = Str::upper(Str::substr(Str::slug($brand->name), 0, 3));
                $counter = 1;
                $code = $baseCode.'-'.sprintf('%03d', $counter);

                // Make sure the code is unique
                while (static::where('code', $code)->exists()) {
                    $counter++;
                    $code = $baseCode.'-'.sprintf('%03d', $counter);
                }

                $brand->code = $code;
            } else {
                // If code is provided but not unique, make it unique
                $originalCode = $brand->code;
                $counter = 1;

                while (static::where('code', $brand->code)->exists()) {
                    $parts = explode('-', $originalCode);
                    $prefix = $parts[0];
                    $brand->code = $prefix.'-'.sprintf('%03d', $counter);
                    $counter++;
                }
            }
        });
    }

    /**
     * Get the company that owns the brand.
     */
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * Get the branch that owns the brand.
     */
    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    /**
     * Get the users associated with the brand.
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_brands')
            ->withPivot('role', 'is_primary')
            ->withTimestamps();
    }
}
