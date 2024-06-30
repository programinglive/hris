<?php

namespace Tests\Feature;

use Tests\TestCase;

class CompanyRegisterTest extends TestCase
{
    public function test_it_check_company_register_view()
    {
        $this->get(route('company.register.index'))->assertStatus(200);
    }
    public function test_can_store_company_data()
    {
        $data = [
            'name' => 'Test Company',
            'email' => 'test@company.com',
            // Add other fields as required
        ];

        $response = $this->postJson(route('company.store'), $data);

        $response->assertStatus(201); // Check for a successful status code
        $response->assertJson($data); // Check if the returned data matches with sent data
        // check in the database
        $this->assertDatabaseHas('companies', $data);
    }

}
