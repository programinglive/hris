<?php

namespace App\Http\Middleware;

use App\Models\Company;
use Closure;
use Illuminate\Http\Request;

class EnsureCompanyExists
{
    public function handle(Request $request, Closure $next)
    {
        if (! Company::exists() && auth()->check()
            && ! request()->routeIs('master.companies')
        ) {
            return redirect()->route('master.companies');
        }

        return $next($request);
    }
}
