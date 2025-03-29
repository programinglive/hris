<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDetails extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'company_id',
        'phone',
        'address',
        'city',
        'state',
        'country',
        'postal_code',
    ];

    protected $casts = [
        'user_id' => 'integer',
        'company_id' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
