<?php

namespace Database\Seeders;

use App\Models\Branch;
use App\Models\Company;
use App\Models\Inventory;
use Illuminate\Database\Seeder;

class InventorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companies = Company::all();

        foreach ($companies as $key => $company) {
            $branch = Branch::find($key + 1);

            Inventory::factory([
                'company_id' => $company->id,
                'branch_id' => $branch->id,
                'company_code' => $company->code,
                'company_name' => $company->name,
                'branch_code' => $branch->code,
                'branch_name' => $branch->name,
                'code' => 'INV'.str_pad((Inventory::count() + 1), 3, '0', STR_PAD_LEFT),
            ])->create();
        }
    }
}
