<?php

namespace Tests\Unit\Domain\Entity;

use App\Domain\Entity\CustomerPlan;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

/**
 * @coversDefaultClass App\Domain\Entity\CustomerPlan
 */
class CustomerPlanTest extends TestCase
{
    use WithFaker;

    /**
     * @test
     * @covers ::__construct
     * @covers ::getId
     * @covers ::getCustomerId
     * @covers ::getServicePlanId
     */
    public function construct(): void
    {
        $id = $this->faker->randomDigitNotZero();
        $customerId = $this->faker->randomDigitNotZero();
        $servicePlanId = $this->faker->randomDigitNotZero();

        $customerPlan = new CustomerPlan($id, $customerId, $servicePlanId);
        $this->assertEquals($id, $customerPlan->getId());
        $this->assertEquals($customerId, $customerPlan->getCustomerId());
        $this->assertEquals($servicePlanId, $customerPlan->getServicePlanId());
    }
}
