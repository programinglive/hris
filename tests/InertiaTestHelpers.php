<?php

namespace Tests;

use Illuminate\Support\Facades\Facade;
use Inertia\Inertia;

trait InertiaTestHelpers
{
    /**
     * Setup Inertia testing by replacing the Inertia facade with a fake version
     * that doesn't actually render anything.
     */
    protected function setupInertiaTest()
    {
        // Skip the Vite manifest check for the test
        $this->withoutVite();

        // Replace the Inertia facade with a fake version
        Facade::clearResolvedInstance('inertia');
        app()->singleton('inertia', function () {
            $inertiaFake = new class
            {
                public function render($component, $props = [])
                {
                    return response()->json([
                        'component' => $component,
                        'props' => $props,
                        'url' => request()->url(),
                    ]);
                }

                public function location($url)
                {
                    return response('', 409)->header('X-Inertia-Location', $url);
                }
            };

            return $inertiaFake;
        });
    }
}
