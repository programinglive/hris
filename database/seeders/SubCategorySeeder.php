<?php

namespace Database\Seeders;

use App\Models\Branch;
use App\Models\Category;
use App\Models\Company;
use App\Models\SubCategory;
use Illuminate\Database\Seeder;

class SubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companies = Company::all();

        foreach ($companies as $key => $company) {
            $branch = Branch::find($key + 1);
            $category = Category::find($key + 1);

            SubCategory::factory([
                'company_id' => $company->id,
                'branch_id' => $branch->id,
                'category_id' => $category->id,
                'company_code' => $company->code,
                'company_name' => $company->name,
                'branch_code' => $branch->code,
                'branch_name' => $branch->name,
                'category_code' => $category->code,
                'category_name' => $category->name,
                'code' => 'SUBC'.str_pad((SubCategory::count() + 1), 3, '0', STR_PAD_LEFT),
            ])->create();
        }
    }
}