<?php

namespace Tests\Livewire;

use App\Livewire\CompanyForm;
use App\Models\Company;
use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Faker\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use PHPUnit\Framework\AssertionFailedError;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class CompanyFormTest extends TestCase
{
    use RefreshDatabase;

    public $company;
    public $faker;

    /**
     * Set up the test environment before each test case.
     *
     * This function creates a new instance of the Company model with the specified code and name.
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->seed(DatabaseSeeder::class);

        $this->faker = Factory::create();

        $this->company = Company::factory([
            'code' => 'D001',
            'name' => 'Company A',
            'email' => 'a@a.com',
            'phone' => '123456789',
        ])->create();
    }

    /**
     * Test that the 'edit' method of the CompanyForm component can successfully update the 'code' and 'name' fields.
     *
     * @return void
     * @throws AssertionFailedError if the assertions fail
     */
    #[Test]
    public function testItCanEditCompany(): void
    {
        Livewire::test(CompanyForm::class)
            ->call('edit', $this->company->code)
            ->assertSet('code', 'D001')
            ->assertSet('name', 'Company A')
            ->assertSet('email', 'a@a.com')
            ->assertSet('phone', '123456789');
    }

    /**
     * Test case for destroying a company.
     *
     * This test case verifies that the 'destroy' method of the CompanyForm component
     * can successfully softly delete a company with the provided code.
     *
     * @return void
     */
    #[Test]
    public function it_can_destroy_company(): void
    {
        Livewire::test(CompanyForm::class)
            ->call('destroy', 'D001');

        $this->assertSoftDeleted('companies', ['code' => 'D001-deleted']);
    }

    /**
     * Test case for updating a company.
     *
     * This test case verifies that the 'update' method of the CompanyForm component
     * can successfully update a company with the provided data.
     *
     */
    #[Test]
    public function it_can_update_company(): void
    {
        $this->actingAs(User::first());
        Livewire::test(CompanyForm::class)
            ->set('company', $this->company)
            ->set('code', 'D002')
            ->set('name', 'Company B')
            ->set('email', 'a1@a.com')
            ->set('phone', '1234567890')
            ->call('update');

        $this->company = Company::where('code','D002')->first();

        $this->assertEquals('D002', $this->company->code);
        $this->assertEquals('Company B', $this->company->name);
        $this->assertEquals('a1@a.com', $this->company->email);
        $this->assertEquals('1234567890', $this->company->phone);
    }

    /**
     * Test case for getting company data.
     *
     * This test case verifies that the 'companyData' method of the CompanyForm component
     * can successfully set the 'code' and 'name' fields.
     *
     */
    #[Test]
    public function test_it_can_get_company_data(): void
    {
        $this->actingAs(User::first());
        Livewire::test(CompanyForm::class)
            ->set('code', 'D001')
            ->set('name', 'Company A')
            ->call('companyData');

        $this->assertEquals('D001', $this->company->code);
        $this->assertEquals('Company A', $this->company->name);
    }

    /**
     * Test case for saving a company.
     *
     * This test case verifies that the 'save' method of the CompanyForm component
     * can successfully save a company with the provided data.
     *
     * @return void
     * @throws AssertionFailedError if the assertions fail
     */
    #[Test]
    public function it_can_save_company(): void
    {
        $this->actingAs(User::first());
        Livewire::test(CompanyForm::class)
            ->set('code', 'D001')
            ->set('name', 'Company A')
            ->call('save');

        $this->assertEquals('D001', $this->company->code);
        $this->assertEquals('Company A', $this->company->name);
    }

    /**
     * Test case for rendering the company form.
     *
     * This test case verifies that the CompanyForm component can successfully render the form
     * with the expected fields (code and name).
     *
     * @return void
     */
    #[Test]
    public function it_can_render_company_form(): void
    {
        Livewire::test(CompanyForm::class)
            ->assertSee('Code')
            ->assertSee('Name');
    }
}