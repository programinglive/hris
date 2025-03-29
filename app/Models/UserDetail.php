<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserDetail extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'employee_id',
        'phone',
        'address',
        'join_date',
        'exit_date',
        'status',
        'gender',
        'birth_date',
        'marital_status',
        'emergency_contact_name',
        'emergency_contact_relationship',
        'emergency_contact_phone',
        'profile_image',
        'company_id',
        'branch_id',
        'department_id',
        'division_id',
        'sub_division_id',
        'level_id',
        'position_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'join_date' => 'date',
        'exit_date' => 'date',
        'birth_date' => 'date',
    ];

    /**
     * Get the user that owns the details.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the company this user belongs to.
     */
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * Get the branch this user belongs to.
     */
    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }
    
    /**
     * Get the department this user belongs to.
     */
    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }
    
    /**
     * Get the division this user belongs to.
     */
    public function division(): BelongsTo
    {
        return $this->belongsTo(Division::class);
    }
    
    /**
     * Get the sub-division this user belongs to.
     */
    public function subDivision(): BelongsTo
    {
        return $this->belongsTo(SubDivision::class);
    }
    
    /**
     * Get the level this user belongs to.
     */
    public function level(): BelongsTo
    {
        return $this->belongsTo(Level::class);
    }
    
    /**
     * Get the position this user holds.
     */
    public function position(): BelongsTo
    {
        return $this->belongsTo(Position::class);
    }
}
