<?php

namespace Tests\Unit\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @coversDefaultClass App\Models\ServiceOption
 */
class ServiceOptionTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function noTests(): void
    {
        $this->assertTrue(true);
    }
}
