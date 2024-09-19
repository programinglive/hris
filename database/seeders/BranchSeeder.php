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
        Branch::factory()->count(5)->create();
        Branch::create([
            'company_id' => Company::first()->id,
            'code' => 'BR0001',
            'name' => 'Main Branch',
        ]);

        Branch::create([
            'company_id' => Company::orderBy('id', 'desc')->first()->id,
            'code' => 'BR0002',
            'name' => 'Branch 1',
        ]);
    }
}
