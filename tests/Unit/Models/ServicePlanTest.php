<?php

namespace Tests\Unit\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @coversDefaultClass App\Models\ServicePlan
 */
class ServicePlanTest extends TestCase
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
