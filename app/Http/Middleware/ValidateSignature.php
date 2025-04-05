<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\URL;

class ValidateSignature
{
    protected Application|Redirector|RedirectResponse $redirect;

    public function __construct(Application $redirect)
    {
        $this->redirect = $redirect;
    }

    public function handle(Request $request, Closure $next, bool $absolute = true): mixed
    {
        if (! $request->hasValidSignature($absolute)) {
            return $request->expectsJson()
                ? response()->json(['message' => 'Invalid signature.'], 403)
                : redirect()->guest(
                    $this->redirect->make(
                        URL::route('login')
                    )
                );
        }

        return $next($request);
    }

    protected function validateTimestamp(Request $request): bool
    {
        if (! $request->hasValidSignature()) {
            return false;
        }

        $maxAge = $request->route()->getAction('expires');

        if (! $maxAge) {
            return true;
        }

        $age = time() - $request->input('timestamp');

        return $age <= $maxAge;
    }
}
