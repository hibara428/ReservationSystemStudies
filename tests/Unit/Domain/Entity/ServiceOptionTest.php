<?php

namespace Tests\Unit\Domain\Entity;

use App\Domain\Entity\ServiceOption;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

/**
 * @coversDefaultClass App\Domain\Entity\ServiceOption
 */
class ServiceOptionTest extends TestCase
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

        $serviceOption = new ServiceOption($id, $name);
        $this->assertEquals($id, $serviceOption->getId());
        $this->assertEquals($name, $serviceOption->getName());
    }
}
