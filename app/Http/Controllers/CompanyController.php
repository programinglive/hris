<?php

namespace App\Http\Controllers;

use App\Models\Company;

class CompanyController extends Controller
{
    public static function generateCode(): string
    {
        $countCompany = Company::withTrashed()->count() + 1;

        return 'COMP'.str_pad($countCompany, 5, '0', STR_PAD_LEFT);

    }
}
