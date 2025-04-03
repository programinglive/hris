<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SystemSetting extends Model
{
    protected $fillable = [
        'company_id',
        'key',
        'value',
        'type',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'value' => 'json'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
