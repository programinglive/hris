<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class RouteTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test to check the home route
     *
     * @return void
     */
    #[Test]
    public function t_check_home_route(): void
    {
        $this->get(route('home'))->assertStatus(200);
    }

    /**
     * @test
     *
     * @return void
     */
    #[Test]
    public function it_checks_about_route(): void
    {
        $this->get(route('about'))->assertStatus(200);
    }

    /**
     * Test case to validate the 'docs' route.
     *
     * @test
     */
    #[Test]
    public function it_checks_docs_route(): void
    {
        $this->get(route('docs'))->assertStatus(200);
    }

    /**
     * Test case to check the password reset route
     *
     * @return void
     */
    #[Test]
    public function it_checks_password_reset_route(): void
    {
        $this->get(route('password.reset'))->assertStatus(200);
    }
}
