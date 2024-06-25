<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RouteTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @return void
     */
    public function test_it_check_home_route()
    {
        $this->get(route('home'))->assertStatus(200);
    }

    public function test_it_check_company_register_route()
    {
        $this->get(route('companyRegister'))->assertStatus(200);
    }

    public function test_it_check_about_route()
    {
        $this->get(route('about'))->assertStatus(200);
    }

    public function test_it_check_docs_route()
    {
        $this->get(route('docs'))->assertStatus(200);
    }
}
