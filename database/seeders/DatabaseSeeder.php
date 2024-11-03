<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            CompanySeeder::class,
            BranchSeeder::class,
            BrandSeeder::class,
            DepartmentSeeder::class,
            DivisionSeeder::class,
            SubDivisionSeeder::class,
            LevelSeeder::class,
            PositionSeeder::class,
            CategorySeeder::class,
            SubCategorySeeder::class,
            EmployeeSeeder::class,
        ]);
    }
}