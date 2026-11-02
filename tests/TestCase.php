<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Tests\Concerns\SkipsViteWhenUnbuilt;

abstract class TestCase extends BaseTestCase
{
    use SkipsViteWhenUnbuilt;
}
