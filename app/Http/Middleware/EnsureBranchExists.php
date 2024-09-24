<?php

namespace App\Http\Middleware;

use App\Models\Branch;
use App\Models\Company;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureBranchExists
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!Branch::exists() && auth()->check()
            && !request()->routeIs('master.branches')
            && Company::exists()
        ) {
            return redirect()->route('master.branches');
        }

        return $next($request);
    }
}