<?php

namespace Tests\Feature;

use Tests\TestCase;

class LandingPageTest extends TestCase
{
    /**
     * Test the view landing page.
     *
     * @return void
     */
    public function test_view_landing_page()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /**
     * This test function checks if the login form is visible on the homepage.
     *
     * @return void
     */
    public function test_see_login_form_on_homepage()
    {
        $response = $this->get('/');

        $response->assertSeeText('Login');
        $response->assertSee('Username');
        $response->assertSee('Password');
    }
}
