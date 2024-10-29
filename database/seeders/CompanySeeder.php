<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companies = [
            [
                'code' => 'C001',
            ],
            [
                'code' => 'C002',
            ],
            [
                'code' => 'C003',
            ],
            [
                'code' => 'C004',
            ],
        ];

        foreach ($companies as $company) {
            Company::factory([
                'code' => $company['code'],
            ])->create();
        }
    }
}
