<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

class BrandFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Brand::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $brandPrefixes = ['Beauty', 'Glow', 'Shine', 'Radiant', 'Natural', 'Pure', 'Fresh', 'Elegant', 'Luxe', 'Premium'];
        $brandSuffixes = ['Skin', 'Care', 'Cosmetics', 'Beauty', 'Spa', 'Wellness', 'Essentials', 'Products', 'Collection', 'Line'];
        
        $prefix = $this->faker->randomElement($brandPrefixes);
        $suffix = $this->faker->randomElement($brandSuffixes);
        $brandName = $prefix . $suffix;
        
        return [
            'name' => $brandName,
            'code' => strtoupper(substr($prefix, 0, 2) . substr($suffix, 0, 2)) . '-' . $this->faker->numerify('###'),
            'logo' => null, // We'll handle logo uploads separately if needed
            'description' => $this->faker->paragraph(),
            'company_id' => Company::factory(),
            'is_active' => $this->faker->boolean(90), // 90% chance of being active
        ];
    }

    /**
     * Indicate that the brand is active.
     *
     * @return static
     */
    public function active()
    {
        return $this->state(function (array $attributes) {
            return [
                'is_active' => true,
            ];
        });
    }

    /**
     * Indicate that the brand is inactive.
     *
     * @return static
     */
    public function inactive()
    {
        return $this->state(function (array $attributes) {
            return [
                'is_active' => false,
            ];
        });
    }
}
