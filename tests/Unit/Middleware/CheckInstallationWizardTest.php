<?php

namespace Tests\Unit\Middleware;

use App\Http\Middleware\CheckInstallationWizard;
use App\Models\Company;
use Illuminate\Http\Request;
use Tests\TestCase;

class CheckInstallationWizardTest extends TestCase
{
    #[Test]
    public function it_redirects_to_installation_wizard_when_no_companies_exist()
    {
        $middleware = new CheckInstallationWizard();
        $request = Request::create('/login', 'GET');

        $response = $middleware->handle($request, function () {
            return response('next');
        });

        $this->assertRedirect($response, route('landing-page.installation-wizard'));
    }

    #[Test]
    public function it_allows_access_when_companies_exist()
    {
        Company::factory()->create();

        $middleware = new CheckInstallationWizard();
        $request = Request::create('/login', 'GET');

        $response = $middleware->handle($request, function () {
            return response('next');
        });

        $this->assertEquals('next', $response->getContent());
    }

    #[Test]
    public function it_allows_access_to_authenticated_users()
    {
        $user = $this->createUser();
        $this->actingAs($user);

        $middleware = new CheckInstallationWizard();
        $request = Request::create('/login', 'GET');

        $response = $middleware->handle($request, function () {
            return response('next');
        });

        $this->assertEquals('next', $response->getContent());
    }

    #[Test]
    public function it_redirects_to_installation_wizard_when_no_companies_exist_and_user_is_not_authenticated()
    {
        $middleware = new CheckInstallationWizard();
        $request = Request::create('/login', 'GET');

        $response = $middleware->handle($request, function () {
            return response('next');
        });

        $this->assertRedirect($response, route('landing-page.installation-wizard'));
    }
}
