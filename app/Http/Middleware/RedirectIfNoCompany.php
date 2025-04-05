<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class RedirectIfNoCompany
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $user = User::find(Auth::id());
            if (! $user || $user->companies()->count() === 0) {
                return Inertia::location(route('register.company'));
            }
        }

        return $next($request);
    }
}
