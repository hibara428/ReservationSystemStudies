<?php

namespace Tests\Unit\Domain\Entity;

use App\Domain\Entity\Store;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

/**
 * @coversDefaultClass App\Domain\Entity\Store
 */
class StoreTest extends TestCase
{
    use WithFaker;

    /**
     * @test
     * @covers ::__construct
     * @covers ::getId
     * @covers ::getName
     * @covers ::getDescription
     * @covers ::getNumOfCompartment
     */
    public function construct(): void
    {
        $id = $this->faker->randomDigitNotZero();
        $name = $this->faker->name();
        $description = $this->faker->text();
        $numOfCompartment = $this->faker->randomDigit();

        $store = new Store(
            $id,
            $name,
            $description,
            $numOfCompartment
        );
        $this->assertEquals($id, $store->getId());
        $this->assertEquals($name, $store->getName());
        $this->assertEquals($description, $store->getDescription());
        $this->assertEquals($numOfCompartment, $store->getNumOfCompartment());
    }
}
