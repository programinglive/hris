<?php

namespace App\Http\Controllers;

use App\Models\SubCategory;

class SubCategoryController extends Controller
{
    public static function generateCode(): string
    {
        $countCompany = SubCategory::withTrashed()->count() + 1;

        return 'SCAT'.str_pad($countCompany, 5, '0', STR_PAD_LEFT);
    }
}
