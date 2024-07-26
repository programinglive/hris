<?php

namespace Database\Seeders;

use App\Models\User;
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

        $user->details()->create([
           'company_id' => 1,
           'branch_id' => 1,
           'user_id' => $user->id,
           'first_name' => $user->name
        ]);

        $user->assignRole('root');

        User::factory()->create();
    }
}