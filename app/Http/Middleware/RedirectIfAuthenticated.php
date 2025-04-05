<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    protected Application|Redirector|RedirectResponse $redirect;

    public function __construct(Application $redirect)
    {
        $this->redirect = $redirect;
    }

    public function handle(Request $request, Closure $next, string ...$guards): mixed
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                return $request->expectsJson()
                    ? response()->json(['message' => 'Unauthenticated.'], 401)
                    : redirect()->guest(
                        $this->redirect->make(
                            URL::route(RouteServiceProvider::HOME)
                        )
                    );
            }
        }

        return $next($request);
    }
}
