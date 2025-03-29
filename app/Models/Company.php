<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Branch;
use App\Models\Brand;

class Company extends Model
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
        'legal_name',
        'tax_id',
        'registration_number',
        'email',
        'phone',
        'address',
        'city',
        'state',
        'postal_code',
        'country',
        'website',
        'logo',
        'description',
        'owner_id',
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

        static::creating(function ($company) {
            if (empty($company->code)) {
                $baseCode = Str::upper(Str::substr(Str::slug($company->name), 0, 5));
                $counter = 1;
                $code = $baseCode;
                
                // Make sure the code is unique
                while (static::where('code', $code)->exists()) {
                    $code = $baseCode . $counter;
                    $counter++;
                }
                
                $company->code = $code;
            }
        });
    }

    /**
     * Get the owner (user) that owns the company.
     */
    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    /**
     * Get the branches for the company.
     */
    public function branches(): HasMany
    {
        return $this->hasMany(Branch::class);
    }

    /**
     * Get the brands for the company.
     */
    public function brands(): HasMany
    {
        return $this->hasMany(Brand::class);
    }
}
