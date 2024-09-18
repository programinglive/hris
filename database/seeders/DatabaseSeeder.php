<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

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
            SubDivisionSeeder::class,
            LevelSeeder::class,
            PositionSeeder::class,
            UserSeeder::class,
            NewsSeeder::class
        ]);
    }
}