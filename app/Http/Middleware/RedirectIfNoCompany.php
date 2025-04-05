<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class RedirectIfNoCompany
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $user = User::find(Auth::id());
            if (!$user || $user->companies()->count() === 0) {
                return Inertia::location(route('register.company'));
            }
        }

        return $next($request);
    }
}
