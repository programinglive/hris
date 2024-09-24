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
     */
    public function run(): void
    {
        User::truncate();

        $user = User::create([
            'name' => 'admin',
            'email' => 'admin@test.com',
            'password' => bcrypt('hrisproject'),
        ]);

        $user->details()->create([
            'company_id' => Company::factory()->create()->id,
            'branch_id' => Branch::factory()->create()->id,
            'code' => 'USR0001',
            'user_id' => $user->id,
            'first_name' => $user->name,
            'role' => 'administrator',
        ]);
    }

    public function uploadBulk(): void
    {
        $dir = base_path('database/bulk/');
        $files = scandir($dir);
        $data = [];

        foreach ($files as $file) {
            if (strpos($file, '.json')) {
                $json = file_get_contents($dir.$file);
                $data[] = json_decode($json, true);
            }
        }

        foreach ($data as $d) {
            foreach ($d as $userName) {
                $code = 'EMP'.str_pad(User::withTrashed()->count() + 1, 7, '0', STR_PAD_LEFT);
                $user = User::create([
                    'name' => strtolower(trim($userName)),
                    'email' => strtolower(trim($userName)).'@test.com',
                    'password' => bcrypt('hrisproject'),
                ]);

                $user->details()->create([
                    'company_id' => 1,
                    'branch_id' => 1,
                    'code' => $code,
                    'user_id' => $user->id,
                    'first_name' => $userName,
                ]);

                echo 'User created: '.$user->name.PHP_EOL;
            }
        }
    }
}
