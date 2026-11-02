<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserDetail extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'employee_code',
        'status',
        'company_id',
        'branch_id',
        'department_id',
        'division_id',
        'sub_division_id',
        'level_id',
        'position_id',
        'join_date',
        'exit_date',
        'gender',
        'date_of_birth',
        'place_of_birth',
        'nationality',
        'marital_status',
        'religion',
        'blood_type',
        'emergency_contact_name',
        'emergency_contact_phone',
        'emergency_contact_relationship',
        'address',
        'city',
        'state',
        'postal_code',
        'country',
        'phone',
        'mobile_phone',
        'email',
        'photo',
        'notes',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'join_date' => 'date',
        'exit_date' => 'date',
        'date_of_birth' => 'date',
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

    /**
     * Convert the model instance to an array.
     *
     * @return array
     */
    public function toArray()
    {
        $array = parent::toArray();

        // Load relationships if they exist. A loaded relation can still be null
        // (nullable FK), and calling only() on null threw a 500 on every
        // employee page whose detail row lacked, say, a position.
        foreach (['company', 'branch', 'department', 'position'] as $relation) {
            if ($this->relationLoaded($relation) && $this->{$relation} !== null) {
                $array[$relation] = $this->{$relation}->only('id', 'name');
            }
        }

        return $array;
    }
}
