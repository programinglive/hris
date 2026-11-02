<?php

namespace Tests\Feature;

use App\Models\Company;
use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * Walks every parameterless GET route as an administrator and reports any that
 * fail. This is a smoke test for the whole interface: a 500 anywhere means a
 * page is broken for real users.
 */
class AllGetRoutesSmokeTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function every_parameterless_get_route_responds(): void
    {
        $company = Company::factory()->create();

        $adminRole = \App\Models\Role::create([
            'company_id' => $company->id,
            'name' => 'administrator',
            'display_name' => 'Administrator',
            'slug' => 'administrator-'.$company->id,
            'is_system' => true,
        ]);

        $admin = User::factory()->create(['email_verified_at' => now()]);
        UserDetail::create([
            'user_id' => $admin->id,
            'company_id' => $company->id,
            'status' => 'active',
        ]);
        $admin->roles()->attach($adminRole->id, ['company_id' => $company->id]);

        $this->actingAs($admin);

        $routes = collect(app('router')->getRoutes()->getRoutes())
            ->filter(fn ($route) => in_array('GET', $route->methods(), true))
            ->map(fn ($route) => $route->uri())
            ->filter(fn ($uri) => ! str_contains($uri, '{') && ! str_starts_with($uri, '_'))
            // Returns 500 deliberately, to exercise the Sentry integration.
            ->reject(fn ($uri) => $uri === 'test-sentry')
            ->map(fn ($uri) => '/'.ltrim($uri, '/'))
            ->unique()
            ->values();

        $failures = [];

        foreach ($routes as $uri) {
            try {
                $response = $this->get($uri);
                $status = $response->getStatusCode();

                if ($status >= 500) {
                    $failures[] = sprintf('%s -> %d', $uri, $status);
                }
            } catch (\Throwable $e) {
                $failures[] = sprintf(
                    '%s -> %s: %s',
                    $uri,
                    class_basename($e),
                    substr($e->getMessage(), 0, 120)
                );
            }
        }

        $checked = $routes->count();

        $this->assertSame(
            [],
            $failures,
            "{$checked} route diperiksa, ".count($failures)." gagal:\n".implode("\n", $failures)
        );
    }
}
