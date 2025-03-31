<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create a main admin user if it doesn't exist
        $admin = User::where('email', 'admin@beautyhris.com')->first();
        if (! $admin) {
            $admin = User::create([
                'name' => 'Admin User',
                'email' => 'admin@beautyhris.com',
                'password' => Hash::make('password'),
            ]);
        }

        // Create predefined companies
        $companies = [
            [
                'name' => 'Beauty World Corporation',
                'legal_name' => 'Beauty World Corporation Pte Ltd',
                'tax_id' => 'TAX-12345678',
                'registration_number' => 'REG-87654321',
                'email' => 'info@beautyhris.com',
                'phone' => '+6221123456789',
                'address' => '123 Beauty Boulevard',
                'city' => 'Jakarta',
                'state' => 'DKI Jakarta',
                'postal_code' => '10110',
                'country' => 'Indonesia',
                'website' => 'https://beautyhris.com',
                'description' => 'Leading beauty and wellness company in Southeast Asia',
                'is_active' => true,
            ],
            [
                'name' => 'Glow Cosmetics',
                'legal_name' => 'Glow Cosmetics Indonesia PT',
                'tax_id' => 'TAX-23456789',
                'registration_number' => 'REG-98765432',
                'email' => 'info@glowcosmetics.com',
                'phone' => '+6221234567890',
                'address' => '456 Glow Avenue',
                'city' => 'Bandung',
                'state' => 'West Java',
                'postal_code' => '40111',
                'country' => 'Indonesia',
                'website' => 'https://glowcosmetics.com',
                'description' => 'Premium cosmetics manufacturer and retailer',
                'is_active' => true,
            ],
            [
                'name' => 'Spa Serenity',
                'legal_name' => 'Spa Serenity Indonesia PT',
                'tax_id' => 'TAX-34567890',
                'registration_number' => 'REG-09876543',
                'email' => 'info@spaserenity.com',
                'phone' => '+6221345678901',
                'address' => '789 Tranquil Road',
                'city' => 'Bali',
                'state' => 'Bali',
                'postal_code' => '80361',
                'country' => 'Indonesia',
                'website' => 'https://spaserenity.com',
                'description' => 'Luxury spa and wellness centers',
                'is_active' => true,
            ],
        ];

        foreach ($companies as $companyData) {
            $company = Company::firstOrCreate(
                ['name' => $companyData['name']],
                array_merge($companyData, ['owner_id' => $admin->id])
            );
        }

        // Create additional random companies
        Company::factory()
            ->count(2)
            ->create([
                'owner_id' => $admin->id,
            ]);
    }
}
