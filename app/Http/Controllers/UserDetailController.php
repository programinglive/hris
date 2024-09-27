<?php

namespace App\Http\Controllers;

use App\Models\UserDetail;

class UserDetailController extends Controller
{
    public static function generateCode(): string
    {
        $count = UserDetail::withTrashed()->count() + 1;

        return 'EMP' . str_pad( $count, 7, '0', STR_PAD_LEFT);
    }
}