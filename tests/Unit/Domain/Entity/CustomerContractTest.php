<?php

namespace Tests\Unit\Domain\Entity;

use App\Domain\Entity\Customer;
use App\Domain\Entity\CustomerContract;
use App\Domain\Entity\CustomerOption;
use App\Domain\Entity\CustomerPlan;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

/**
 * @coversDefaultClass App\Domain\Entity\CustomerContract
 */
class CustomerContractTest extends TestCase
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
        $customer = $this->createCustomer();
        $customerPlan = $this->createCustomerPlan();

        $customerContract = new CustomerContract($customer, $customerPlan, []);
        $this->assertEquals($customer, $customerContract->getCustomer());
        $this->assertEquals($customerPlan, $customerContract->getCustomerPlan());
    }

    /**
     * @test
     * @covers ::getServiceOptionIds
     */
    public function getServiceOptionIds(): void
    {
        $customer = $this->createCustomer();
        $customerPlan = $this->createCustomerPlan();
        $customerOptions = [
            $this->createCustomerOption(),
            $this->createCustomerOption(),
        ];
        $expected = [
            $customerOptions[0]->getServiceOptionId(),
            $customerOptions[1]->getServiceOptionId(),
        ];

        $customerContract = new CustomerContract($customer, $customerPlan, $customerOptions);
        $this->assertEquals($expected, $customerContract->getServiceOptionIds());
    }

    /**
     * @return Customer
     */
    private function createCustomer(): Customer
    {
        $id = $this->faker->randomDigitNotZero();
        $name = $this->faker->name();
        $email = $this->faker->email();
        $age = $this->faker->randomDigitNotZero();
        $userId = $this->faker->randomDigitNotZero();
        return new Customer(
            $id,
            $name,
            $email,
            $age,
            $userId
        );
    }

    /**
     * @return CustomerPlan
     */
    private function createCustomerPlan(): CustomerPlan
    {
        $id = $this->faker->randomDigitNotZero();
        $customerId = $this->faker->randomDigitNotZero();
        $servicePlanId = $this->faker->randomDigitNotZero();
        return new CustomerPlan($id, $customerId, $servicePlanId);
    }

    /**
     * @return CustomerOption
     */
    private function createCustomerOption(): CustomerOption
    {
        $id = $this->faker->randomDigitNotZero();
        $customerId = $this->faker->randomDigitNotZero();
        $serviceOptionId = $this->faker->randomDigitNotZero();
        return new CustomerOption($id, $customerId, $serviceOptionId);
    }
}
