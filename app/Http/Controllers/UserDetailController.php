<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserDetailController extends Controller
{
    /**
     * Generate a new employee code.
     *
     * This function generates a new employee code in the format "YY-MM-XXXX".
     * The "YY" represents the current year, the "MM" represents the current month,
     * and the "XXXX" represents the incrementing number.
     *
     * @return string The new employee code.
     */
    public static function generateNik(): string
    {
        $now = now();
        $year = $now->format('y');
        $month = $now->format('m');
        $lastUser = User::where('name', '!=', 'admin')->latest()->first();
        $lastCode = $lastUser?->employee_code;
        $lastIncrement = $lastCode ? (int) substr($lastCode, -4) : 0;
        $increment = str_pad($lastIncrement + 1, 4, '0', STR_PAD_LEFT);

        return "$year$month$increment";
    }
}
