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
    public static function generateCode(): string
    {
        $countBranch = Branch::withTrashed()->count() + 1;

        return 'B'.str_pad($countBranch, 5, '0', STR_PAD_LEFT);

    }

    /**
     * @param  null  $name
     */
    public static function createByName($company, $name = null): Branch
    {
        $branch = Branch::firstOrNew([
            'name' => $name,
        ]);

        if (! $branch->code) {
            $branch->company_id = $company->id;
            $branch->code = BranchController::generateCode();
            $branch->company_code = $company->code;
            $branch->company_name = $company->name;
        }
        $branch->save();

        return $branch;
    }
}
