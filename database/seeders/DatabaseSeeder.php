<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        exec('php artisan migrate:fresh');

        $this->call([
            CompanySeeder::class,
            BranchSeeder::class,
            BrandSeeder::class,
            DepartmentSeeder::class,
            DivisionSeeder::class,
            LevelSeeder::class,
            PositionSeeder::class,
            UserSeeder::class,
        ]);
    }
}