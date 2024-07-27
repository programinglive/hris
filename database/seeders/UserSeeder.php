<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run method to create an admin user and factory user.
     *
     * @return void
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'admin',
            'email' => 'admin@test.com',
            'password' => bcrypt('hrisproject'),
        ]);

        $faker = Factory::create();

        $user->details()->create([
           'company_id' => 1,
           'branch_id' => 1,
           'user_id' => $user->id,
           'first_name' => $user->name,
           'phone' => $faker->phoneNumber(),
        ]);

        $user->assignRole('root');

        User::factory(10)->create();
    }
}