<?php

namespace App\Http\Controllers;

use App\Models\Category;

class CategoryController extends Controller
{
    public static function generateCode(): string
    {
        $latest = Category::withTrashed()->count() + 1;

        return 'CTG'.str_pad($latest, 4, '0', STR_PAD_LEFT);
    }
}
