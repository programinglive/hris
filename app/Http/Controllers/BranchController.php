<?php

namespace App\Http\Controllers;

use App\Models\Branch;

class BranchController extends Controller
{
    /**
     * Generates a branch code by incrementing the count of existing branches and padding it with leading zeros.
     *
     * @return string The generated branch code.
     */
    public static function generateCode()
    {
        return 'B' . str_pad(Branch::withTrashed()->count() + 1, 7, "0", STR_PAD_LEFT);
    }
}