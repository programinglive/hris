<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Role extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'display_name',
        'description',
        'is_system',
        'slug',
        'company_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_system' => 'boolean',
    ];

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($role) {
            if (empty($role->slug)) {
                $baseSlug = Str::slug($role->name);
                $slug = $baseSlug;
                $counter = 1;

                // Check for existing role with the same slug
                while (Role::where('slug', $slug)->exists()) {
                    $slug = $baseSlug.'_'.$counter;
                    $counter++;
                }

                $role->slug = $slug;
            }
        });
    }

    /**
     * The company that the role belongs to.
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * The users that belong to the role.
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_roles')
            ->using(UserRole::class)
            ->withPivot('company_id');
    }

    /**
     * Check if this is the administrator role.
     */
    public function isAdministrator(): bool
    {
        return $this->name === 'administrator';
    }

    /**
     * Check if this is the employee role.
     */
    public function isEmployee(): bool
    {
        return $this->name === 'employee';
    }

    /**
     * Check if the role has a specific permission.
     *
     * @param  string  $permission
     * @return bool
     */
    public function hasPermission($permission)
    {
        // Implement permission checking logic here
        return false;
    }
}
