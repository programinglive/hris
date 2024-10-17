<?php

namespace App\Http\Controllers;

use App\Models\UserDetail;

class UserDetailController extends Controller
{
    /**
     * Generate NIK of employee
     *
     * @return string NIK of employee
     */
    public static function generateNik(): string
    {
        $count = UserDetail::withTrashed()->count() + 1;

        return 'EMP'.str_pad($count, 7, '0', STR_PAD_LEFT);
    }
}