<?php

namespace Tests\Feature;

use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * Every Inertia::render('page') must have a matching .tsx file under
 * resources/js/Pages. When it does not, the page 500s at runtime with
 * "Unable to locate file in Vite manifest" — a failure that unit tests never
 * see because it only happens during rendering.
 *
 * The comparison is case-sensitive on purpose: the production host runs Linux,
 * where Pages/Auth and pages/auth are different directories.
 */
class InertiaPagesExistTest extends TestCase
{
    #[Test]
    public function every_inertia_render_target_has_a_page_component(): void
    {
        $pagesDir = resource_path('js/Pages');

        $available = [];

        $iterator = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($pagesDir, \FilesystemIterator::SKIP_DOTS)
        );

        foreach ($iterator as $file) {
            if (! $file->isFile() || ! str_ends_with($file->getFilename(), '.tsx')) {
                continue;
            }

            $relative = str_replace($pagesDir.'/', '', $file->getPathname());
            $available[] = substr($relative, 0, -4);
        }

        $targets = [];

        $controllers = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator(app_path('Http/Controllers'), \FilesystemIterator::SKIP_DOTS)
        );

        foreach ($controllers as $file) {
            if (! $file->isFile() || ! str_ends_with($file->getFilename(), '.php')) {
                continue;
            }

            $source = file_get_contents($file->getPathname());

            if (preg_match_all("/Inertia::render\(\s*'([^']+)'/", $source, $matches)) {
                foreach ($matches[1] as $target) {
                    $targets[$target] = str_replace(base_path().'/', '', $file->getPathname());
                }
            }
        }

        $this->assertNotEmpty($targets, 'Tidak ada Inertia::render yang ditemukan — tes ini tidak menguji apa pun.');

        $missing = [];

        foreach ($targets as $target => $source) {
            if (! in_array($target, $available, true)) {
                $missing[] = "{$target}  (dipanggil dari {$source})";
            }
        }

        $this->assertSame(
            [],
            $missing,
            count($targets)." halaman diperiksa, ".count($missing)." tidak punya komponen:\n".implode("\n", $missing)
        );
    }
}
