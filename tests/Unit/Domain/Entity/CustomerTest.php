<?php

namespace Tests\Unit\Domain\Entity;

use App\Domain\Entity\Customer;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

/**
 * @coversDefaultClass App\Domain\Entity\Customer
 */
class CustomerTest extends TestCase
{
    use WithFaker;

    /**
     * @test
     * @covers ::__construct
     * @covers ::getId
     * @covers ::getName
     * @covers ::getEmail
     * @covers ::getAge
     * @covers ::getUserId
     */
    public function construct(): void
    {
        $id = $this->faker->randomDigitNotZero();
        $name = $this->faker->name();
        $email = $this->faker->email();
        $age = $this->faker->randomDigitNotZero();
        $userId = $this->faker->randomDigitNotZero();

        $customer = new Customer(
            $id,
            $name,
            $email,
            $age,
            $userId
        );
        $this->assertEquals($id, $customer->getId());
        $this->assertEquals($name, $customer->getName());
        $this->assertEquals($email, $customer->getEmail());
        $this->assertEquals($age, $customer->getAge());
        $this->assertEquals($userId, $customer->getUserId());
    }
}
