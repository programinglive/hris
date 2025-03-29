<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Department extends Model
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
        'description',
        'manager_id',
        'status',
        'company_id',
        'branch_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'status' => 'string',
    ];

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($department) {
            if (empty($department->code)) {
                $baseCode = Str::upper(Str::substr(Str::slug($department->name), 0, 3));
                $counter = 1;
                $code = $baseCode . '-' . sprintf('%03d', $counter);
                
                // Make sure the code is unique
                while (static::where('code', $code)->exists()) {
                    $counter++;
                    $code = $baseCode . '-' . sprintf('%03d', $counter);
                }
                
                $department->code = $code;
            }
        });
    }

    /**
     * Get the manager of the department.
     */
    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }

    /**
     * Get the employees in the department.
     */
    public function employees()
    {
        return $this->hasMany(UserDetail::class, 'department_id');
    }
    
    /**
     * Get the divisions in the department.
     */
    public function divisions()
    {
        return $this->hasMany(Division::class);
    }
    
    /**
     * Get the company that the department belongs to.
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
    
    /**
     * Get the branch that the department belongs to.
     */
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
}
