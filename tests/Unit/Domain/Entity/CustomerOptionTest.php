<?php

namespace Tests\Unit\Domain\Entity;

use App\Domain\Entity\CustomerOption;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

/**
 * @coversDefaultClass App\Domain\Entity\CustomerOption
 */
class CustomerOptionTest extends TestCase
{
    use WithFaker;

    /**
     * @test
     * @covers ::__construct
     * @covers ::getId
     * @covers ::getCustomerId
     * @covers ::getServiceOptionId
     */
    public function construct(): void
    {
        $id = $this->faker->randomDigitNotZero();
        $customerId = $this->faker->randomDigitNotZero();
        $serviceOptionId = $this->faker->randomDigitNotZero();

        $customerOption = new CustomerOption($id, $customerId, $serviceOptionId);
        $this->assertEquals($id, $customerOption->getId());
        $this->assertEquals($customerId, $customerOption->getCustomerId());
        $this->assertEquals($serviceOptionId, $customerOption->getServiceOptionId());
    }
}
