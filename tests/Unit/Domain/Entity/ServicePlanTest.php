<?php

namespace Tests\Unit\Domain\Entity;

use App\Domain\Entity\ServicePlan;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

/**
 * @coversDefaultClass App\Domain\Entity\ServicePlan
 */
class ServicePlanTest extends TestCase
{
    use WithFaker;

    /**
     * @test
     * @covers ::__construct
     * @covers ::getId
     * @covers ::getName
     */
    public function construct(): void
    {
        $id = $this->faker->randomDigitNotZero();
        $name = $this->faker->name();

        $servicePlan = new ServicePlan($id, $name);
        $this->assertEquals($id, $servicePlan->getId());
        $this->assertEquals($name, $servicePlan->getName());
    }
}
