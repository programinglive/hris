<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\QueryException;
use Exception;

class UserBrand extends Pivot
{
    protected $table = 'user_brands';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'brand_id',
        'role',
        'is_primary',
        'company_id'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_primary' => 'boolean',
    ];

    /**
     * Get the user that owns the user_brand.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the brand that owns the user_brand.
     */
    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    /**
     * Get the company that owns the user_brand.
     */
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function (UserBrand $userBrand) {
            if ($userBrand->company_id !== $userBrand->user->company_id) {
                throw new QueryException(
                    'Company ID mismatch between user and brand',
                    'Company ID mismatch between user and brand',
                    [],
                    new Exception()
                );
            }
        });
    }
}
