<?php

namespace Database\Seeders;

use App\Models\Branch;
use App\Models\Company;
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
           'company_id' => Company::first()->id,
           'branch_id' => Branch::first()->id,
           'user_id' => $user->id,
           'first_name' => $user->name,
        ]);
    }
}