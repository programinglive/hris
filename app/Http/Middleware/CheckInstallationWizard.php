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

        // If companies exist, redirect to login
        if ($hasCompanies) {
            return redirect()->route('login');
        }

        // If no companies exist, redirect to login
        return redirect()->route('login');

        return $next($request);
    }
}
