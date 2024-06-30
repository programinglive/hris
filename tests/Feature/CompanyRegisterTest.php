<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Faker\Factory as Faker;


class CompanyRegisterTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_check_company_register_view()
    {
        $this->get(route('company.register.index'))->assertStatus(200);
    }
    public function test_can_store_company_data()
    {
        $faker = Faker::create();

        $data = [
            'user_id' => User::factory()->create()->id,
            'code' => $faker->unique()->numerify('####'),
            'name' => $faker->company,
            'email' => $faker->companyEmail,
            'website' => $faker->domainName,
            'logo' => 'path/to/fake/logo', // Unfortunately, faker does not generate fake paths
            'phone' => $faker->phoneNumber,
            'address' => $faker->address,
            'city' => $faker->city,
            'state' => $faker->state,
            'country' => $faker->country,
            'postal_code' => $faker->postcode,
            'is_active' => true // Unfortunately, faker does not generate boolean values
        ];

        $response = $this->postJson(route('company.store'), $data);

        $response->assertStatus(201); // Check for a successful status code
        $response->assertJson([
            'status' => 'success',
            'message' => 'Company created successfully',
            'data' => $data
        ]); // Check if the returned data matches with sent data
        // check in the database
        $this->assertDatabaseHas('companies', $data);
    }

}
