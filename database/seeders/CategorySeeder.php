<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Company;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companies = Company::all();

        foreach ($companies as $company) {
            $branch = $company->branches()->first();
            Category::factory([
                'company_id' => $company->id,
                'branch_id' => $branch->id,
                'company_code' => $company->code,
                'company_name' => $company->name,
                'branch_code' => $branch->code,
                'branch_name' => $branch->name,
                'code' => 'CAT'.str_pad((Category::count() + 1), 3, '0', STR_PAD_LEFT),
            ])->create();
        }
    }
}
