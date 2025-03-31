<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Company;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing brands to avoid duplicates
        DB::statement('PRAGMA foreign_keys = OFF');
        Brand::truncate();
        DB::statement('PRAGMA foreign_keys = ON');

        // Get all companies
        $companies = Company::all();

        if ($companies->isEmpty()) {
            // This should not happen as CompanySeeder should have been run first
            $this->command->info('No companies found. Please run CompanySeeder first.');

            return;
        }

        // Company-specific brand mappings
        $companySpecificBrands = [
            'Beauty World Corporation' => [
                [
                    'name' => 'BeautyGlow',
                    'code' => 'BG-001',
                    'description' => 'Premium skincare products for all skin types',
                    'is_active' => true,
                ],
                [
                    'name' => 'NaturalEssence',
                    'code' => 'NE-001',
                    'description' => 'Organic and natural beauty products',
                    'is_active' => true,
                ],
                [
                    'name' => 'LuxeHair',
                    'code' => 'LH-001',
                    'description' => 'Professional hair care products and treatments',
                    'is_active' => true,
                ],
            ],
            'Glow Cosmetics' => [
                [
                    'name' => 'GlowSkin',
                    'code' => 'GS-001',
                    'description' => 'Skin brightening and glowing products',
                    'is_active' => true,
                ],
                [
                    'name' => 'GlowMakeup',
                    'code' => 'GM-001',
                    'description' => 'Professional makeup for a radiant look',
                    'is_active' => true,
                ],
            ],
            'Spa Serenity' => [
                [
                    'name' => 'SpaRelax',
                    'code' => 'SR-001',
                    'description' => 'Spa and relaxation products and services',
                    'is_active' => true,
                ],
                [
                    'name' => 'ZenBeauty',
                    'code' => 'ZB-001',
                    'description' => 'Holistic beauty and wellness products',
                    'is_active' => true,
                ],
            ],
        ];

        // Generic brands for any company not specifically mapped
        $genericBrands = [
            [
                'name' => 'PremiumBeauty',
                'code' => 'PB-001',
                'description' => 'High-end beauty products',
                'is_active' => true,
            ],
            [
                'name' => 'EssentialCare',
                'code' => 'EC-001',
                'description' => 'Essential beauty and personal care products',
                'is_active' => true,
            ],
            [
                'name' => 'BeautyTech',
                'code' => 'BT-001',
                'description' => 'Beauty technology and devices',
                'is_active' => true,
            ],
        ];

        // Create brands for each company
        foreach ($companies as $company) {
            // Use company-specific brands if available, otherwise use generic brands
            $brandsToCreate = $companySpecificBrands[$company->name] ?? $genericBrands;

            foreach ($brandsToCreate as $brandData) {
                Brand::create(array_merge($brandData, [
                    'company_id' => $company->id,
                ]));
            }

            // Add 1-2 random brands per company
            $randomBrandCount = rand(1, 2);
            Brand::factory()
                ->count($randomBrandCount)
                ->create([
                    'company_id' => $company->id,
                ]);
        }
    }
}
