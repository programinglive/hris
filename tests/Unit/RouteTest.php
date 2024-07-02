<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RouteTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test case for checking the home route of the application.
     *
     * @group laravel
     * @group hris
     */
    public function test_it_check_home_route(): void
    {
        $this->get(route('home'))->assertStatus(200);
    }

    /**
     * Test case for checking the about route of the application.
     *
     * @group laravel
     * @group hris
     */
    public function test_it_check_about_route(): void
    {
        $this->get(route('about'))->assertStatus(200);
    }

    /**
     * Test case for checking the docs route of the application.
     *
     * @group laravel
     * @group hris
     */
    public function test_it_check_docs_route(): void
    {
        $this->get(route('docs'))->assertStatus(200);
    }

    /**
     * Test case for checking the password reset route of the application.
     *
     * @group laravel
     * @group hris
     */
    public function test_it_check_password_reset_route(): void
    {
        $this->get(route('password.reset'))->assertStatus(200);
    }
}
