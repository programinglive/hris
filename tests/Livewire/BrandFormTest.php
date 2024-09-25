<?php

namespace Tests\Livewire;

use App\Livewire\BrandForm;
use App\Models\Brand;
use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use PHPUnit\Framework\AssertionFailedError;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class BrandFormTest extends TestCase
{
    use RefreshDatabase;

    public $brand;

    /**
     * Set up the test environment before each test case.
     *
     * This function creates a new instance of the Brand model with the specified code and name.
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->seed(DatabaseSeeder::class);

        $this->brand = Brand::factory([
            'code' => 'D001',
            'name' => 'Brand A',
        ])->create();
    }

    /**
     * Test that the 'edit' method of the BrandForm component can successfully update the 'code' and 'name' fields.
     *
     * @throws AssertionFailedError if the assertions fail
     */
    #[Test]
    public function testItCanEditBrand(): void
    {
        Livewire::test(BrandForm::class)
            ->call('edit', $this->brand->code)
            ->assertSet('code', 'D001')
            ->assertSet('name', 'Brand A');
    }

    /**
     * Test case for destroying a brand.
     *
     * This test case verifies that the 'destroy' method of the BrandForm component
     * can successfully softly delete a brand with the provided code.
     */
    #[Test]
    public function it_can_destroy_brand(): void
    {
        Livewire::test(BrandForm::class)
            ->call('destroy', 'D001');

        $this->assertSoftDeleted('brands', ['code' => 'D001-deleted']);
    }

    /**
     * Test case for updating a brand.
     *
     * This test case verifies that the 'update' method of the BrandForm component
     * can successfully update a brand with the provided data.
     */
    #[Test]
    public function it_can_update_brand(): void
    {
        $this->actingAs(User::first());
        Livewire::test(BrandForm::class)
            ->set('brand', $this->brand)
            ->set('code', 'D002')
            ->set('name', 'Brand B')
            ->call('update');

        $this->brand = Brand::where('code', 'D002')->first();

        $this->assertEquals('D002', $this->brand->code);
        $this->assertEquals('Brand B', $this->brand->name);
    }

    /**
     * Test case for getting brand data.
     *
     * This test case verifies that the 'brandData' method of the BrandForm component
     * can successfully set the 'code' and 'name' fields.
     */
    #[Test]
    public function test_it_can_get_brand_data(): void
    {
        $this->actingAs(User::first());
        Livewire::test(BrandForm::class)
            ->set('code', 'D001')
            ->set('name', 'Brand A')
            ->call('brandData');

        $this->assertEquals('D001', $this->brand->code);
        $this->assertEquals('Brand A', $this->brand->name);
    }

    /**
     * Test case for saving a brand.
     *
     * This test case verifies that the 'save' method of the BrandForm component
     * can successfully save a brand with the provided data.
     *
     * @throws AssertionFailedError if the assertions fail
     */
    #[Test]
    public function it_can_save_brand(): void
    {
        $this->actingAs(User::first());
        Livewire::test(BrandForm::class)
            ->set('code', 'D001')
            ->set('name', 'Brand A')
            ->call('save');

        $this->assertEquals('D001', $this->brand->code);
        $this->assertEquals('Brand A', $this->brand->name);
    }

    /**
     * Test case for rendering the brand form.
     *
     * This test case verifies that the BrandForm component can successfully render the form
     * with the expected fields (code and name).
     */
    #[Test]
    public function it_can_render_brand_form(): void
    {
        Livewire::test(BrandForm::class)
            ->assertSee('Code')
            ->assertSee('Name');
    }
}
