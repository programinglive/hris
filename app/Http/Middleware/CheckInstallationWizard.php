<?php

namespace App\Http\Middleware;

use App\Models\Company;
use Closure;
use Illuminate\Http\Request;

class CheckInstallationWizard
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): mixed
    {
        // Check if there are any companies in the database
        $hasCompanies = Company::count() > 0;

        // If no companies exist and user is not authenticated, redirect to installation wizard
        if (! $hasCompanies && ! $request->user()) {
            return redirect()->route('landing-page.installation-wizard');
        }

        // If no companies exist and user is authenticated, redirect to company registration
        if (! $hasCompanies && $request->user()) {
            return redirect()->route('register.company.show');
        }

        return $next($request);
    }
}
