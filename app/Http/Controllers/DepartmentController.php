<?php

namespace App\Http\Controllers;

use App\Models\Department;

class DepartmentController extends Controller
{
    /**
     * Generates a department code by incrementing the count of existing departments and padding it with leading zeros.
     *
     * @return string The generated department code.
     */
    public static function generateCode()
    {
        return 'D'.str_pad(Department::withTrashed()->count() + 1, 3, '0', STR_PAD_LEFT);
    }
}
