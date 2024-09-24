<?php

namespace App\Http\Controllers;

use App\Models\Category;

class CategoryController extends Controller
{
    public static function generateCode(): string
    {
        $countCompany = Category::withTrashed()->count() + 1;

        return 'CAT'.str_pad($countCompany, 5, '0', STR_PAD_LEFT);
    }
}
