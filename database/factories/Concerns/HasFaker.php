<?php

namespace Database\Factories\Concerns;

use Faker\Factory as FakerFactory;
use Faker\Generator;

/**
 * Gives factories a Faker generator that works outside the test bootstrap.
 *
 * Laravel populates Factory::$faker only when the framework builds it, which
 * happens during tests. When a factory is used from a seeder against a real
 * database, $this->faker is null and every call dies.
 *
 * The generator is memoized so that ->unique() keeps its state across the
 * fields of one definition; creating a new generator per call would silently
 * reset uniqueness and allow duplicate values.
 */
trait HasFaker
{
    private ?Generator $fakerInstance = null;

    protected function faker(): Generator
    {
        return $this->fakerInstance ??= FakerFactory::create();
    }
}
