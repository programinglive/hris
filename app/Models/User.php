<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'company_id',
        'branch_id',
        'department_id',
        'position_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the companies owned by the user.
     */
    public function companies(): HasMany
    {
        return $this->hasMany(Company::class, 'owner_id');
    }

    /**
     * Get the user's details.
     */
    public function userDetails(): HasOne
    {
        return $this->hasOne(UserDetail::class);
    }

    /**
     * Get all of the brands that are associated with the user.
     */
    public function brands(): BelongsToMany
    {
        return $this->belongsToMany(Brand::class, 'user_brands')
            ->using(UserBrand::class)
            ->withPivot([
                'role',
                'is_primary',
                'created_at',
                'updated_at',
            ])
            ->withTimestamps()
            ->wherePivot('company_id', $this->company_id);
    }

    /**
     * Get the company this user belongs to through user details.
     */
    public function company()
    {
        return $this->hasOneThrough(Company::class, UserDetail::class, 'user_id', 'id', 'id', 'company_id');
    }

    /**
     * Get the branch this user belongs to through user details.
     */
    public function branch()
    {
        return $this->hasOneThrough(Branch::class, UserDetail::class, 'user_id', 'id', 'id', 'branch_id');
    }

    /**
     * Get the roles that belong to the user.
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'user_roles', 'user_id', 'role_id')
            ->withTimestamps();
    }

    /**
     * Check if the user has a specific role.
     */
    public function hasRole(string $roleName): bool
    {
        return $this->roles()->where('name', $roleName)->exists();
    }

    /**
     * Check if the user is an administrator.
     */
    public function isAdministrator(): bool
    {
        return $this->hasRole('administrator');
    }

    /**
     * Check if the user is an employee.
     */
    public function isEmployee(): bool
    {
        return $this->hasRole('employee');
    }

    /**
     * Assign a role to the user.
     */
    public function assignRole(string|Role $role): void
    {
        if (is_string($role)) {
            $role = Role::where('name', $role)->firstOrFail();
        }

        if (! $this->hasRole($role->name)) {
            $this->roles()->attach($role);
        }
    }

    /**
     * Remove a role from the user.
     *
     * @param  string|Role  $role
     */
    public function removeRole($role): void
    {
        if (is_string($role)) {
            $role = Role::where('name', $role)->firstOrFail();
        }

        $this->roles()->detach($role);
    }

    /**
     * Get the leave requests for this user.
     */
    public function leaveRequests(): HasMany
    {
        return $this->hasMany(LeaveRequest::class);
    }

    /**
     * Get all work shifts assigned to the user.
     */
    public function workShifts(): BelongsToMany
    {
        return $this->belongsToMany(WorkShift::class, 'user_work_shifts')
            ->using(UserWorkShift::class)
            ->withPivot([
                'date',
                'created_at',
                'updated_at',
            ])
            ->withTimestamps()
            ->where('work_shifts.company_id', $this->company_id);
    }

    /**
     * Get all work schedules assigned to the user.
     */
    public function workSchedules(): BelongsToMany
    {
        return $this->belongsToMany(WorkSchedule::class, 'user_work_schedules')
            ->withPivot('effective_date', 'end_date', 'is_active')
            ->withTimestamps();
    }

    /**
     * Get the active work schedule for this user.
     */
    public function getActiveWorkScheduleAttribute()
    {
        $today = now()->format('Y-m-d');

        return $this->hasOne(UserWorkSchedule::class)
            ->where('is_active', true)
            ->where(function ($query) use ($today) {
                $query->where('effective_date', '<=', $today)
                    ->where(function ($q) use ($today) {
                        $q->where('end_date', '>=', $today)
                            ->orWhereNull('end_date');
                    });
            })
            ->latest('effective_date')
            ->first();
    }
}
