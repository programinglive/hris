<?php

namespace Tests\Concerns;

/**
 * Keeps the suite meaningful on a fresh clone.
 *
 * The compiled frontend lives in `public/build`, which is git-ignored. Without
 * it every Inertia response throws "Vite manifest not found", so tests fail
 * before reaching the assertions they make about the application.
 *
 * When the manifest is missing we swap in Laravel's null Vite handler, which
 * renders no tags. Once `npm run build` has produced a real manifest, the
 * normal Vite instance is used and nothing is stubbed.
 */
trait SkipsViteWhenUnbuilt
{
    protected function setUpTraits()
    {
        $result = parent::setUpTraits();

        if (! is_file($this->app->publicPath('build/manifest.json'))) {
            $this->withoutVite();
        }

        return $result;
    }
}
