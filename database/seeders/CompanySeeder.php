<?php

namespace Database\Seeders;

use App\Models\Setting;
use App\Models\Company;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Company::factory()->create();

        Setting::factory()->create();
    }
}
