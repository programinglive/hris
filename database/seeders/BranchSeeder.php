<?php

namespace Database\Seeders;

use App\Models\Branch;
use App\Models\Company;
use Illuminate\Database\Seeder;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companies = Company::all();

        foreach ($companies as $company) {
            Branch::factory([
                'company_id' => $company->id,
                'company_code' => $company->code,
                'company_name' => $company->name,
                'code' => 'B'.str_pad((Branch::count() + 1), 3, '0', STR_PAD_LEFT),
            ])->create();
        }
    }
}