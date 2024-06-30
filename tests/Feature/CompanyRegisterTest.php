<?php

namespace Tests\Feature;

use Tests\TestCase;

class CompanyRegisterTest extends TestCase
{
    public function test_it_check_company_register_route()
    {
        $this->get(route('companyRegister'))->assertStatus(200);
    }

}
