<?php

namespace Tests\Feature;

use Tests\TestCase;

class PageHeaderTest extends TestCase
{
    public function test_it_check_has_company_register_route()
    {
        $response = $this->get(route('company.register.index'));

        $response->assertStatus(200);
    }

    public function test_it_check_link_register_exist()
    {
        $response = $this->get('/'); // for example, home page

        $response->assertSee('Register');
    }

    public function test_it_check_menu_register_exist()
    {
        $response = $this->get('/'); // for example, home page

        $response->assertSee('/company/register');
    }
}
