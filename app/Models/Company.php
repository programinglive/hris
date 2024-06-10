<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'website',
        'logo',
        'phone',
        'address',
        'city',
        'state',
        'country',
        'postal_code',
        'is_active'
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

}
