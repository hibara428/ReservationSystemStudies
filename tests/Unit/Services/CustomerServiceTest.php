<?php

namespace Tests\Unit\Services;

use App\Domain\Entity\Customer;
use App\Domain\Entity\CustomerContract;
use App\Domain\Entity\CustomerOption;
use App\Domain\Entity\CustomerPlan;
use App\Domain\Entity\ServiceOption;
use App\Domain\Entity\ServicePlan;
use App\Domain\Repository\CustomerContractRepository;
use App\Domain\Repository\ServiceOptionRepository;
use App\Domain\Repository\ServicePlanRepository;
use App\Services\CustomerService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Mockery;
use Tests\TestCase;

/**
 * @coversDefaultClass App\Services\CustomerService
 */
class CustomerServiceTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;

    /**
     * Tear down
     *
     * @return void
     */
    public function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    /**
     * @test
     * @covers ::findCustomerContractByUserId
     */
    public function findCustomerContractByUserId_hasRecords(): void
    {
        // Data set
        $customer = new Customer(
            $this->faker->randomDigitNotZero(),
            $this->faker->name(),
            $this->faker->safeEmail(),
            $this->faker->randomDigitNotZero(),
            $this->faker->randomDigitNotZero()
        );
        $expected = new CustomerContract(
            $customer,
            new CustomerPlan(
                $this->faker->randomDigitNotZero(),
                $customer->getId(),
                $this->faker->randomDigitNotZero()
            ),
            [
                new CustomerOption(
                    $this->faker->randomDigitNotZero(),
                    $customer->getId(),
                    $this->faker->randomDigitNotZero()
                ),
            ]
        );

        // Mocks
        /** @var MockeryInterface $customerContractReposMock */
        $customerContractReposMock = Mockery::mock(CustomerContractRepository::class);
        $customerContractReposMock->shouldReceive('findByUserId')
            ->once()
            ->withArgs([0])
            ->andReturn($expected);
        /** @var MockeryInterface $servicePlanReposMock */
        $servicePlanReposMock = Mockery::mock(ServicePlanRepository::class);
        /** @var MockeryInterface $serviceOptionReposMock */
        $serviceOptionReposMock = Mockery::mock(ServiceOptionRepository::class);

        // Tests
        /** @var CustomerContractRepository $customerContractReposMock */
        /** @var ServicePlanRepository $servicePlanReposMock */
        /** @var ServiceOptionRepository $serviceOptionReposMock */
        $service = new CustomerService($customerContractReposMock, $servicePlanReposMock, $serviceOptionReposMock);
        $this->assertEquals($expected, $service->findCustomerContractByUserId(0));
    }

    /**
     * @test
     * @covers ::findCustomerContractByUserId
     */
    public function findCustomerContractByUserId_emptyRecords(): void
    {
        // Mocks
        /** @var MockeryInterface $customerContractReposMock */
        $customerContractReposMock = Mockery::mock(CustomerContractRepository::class);
        $customerContractReposMock->shouldReceive('findByUserId')
            ->once()
            ->withArgs([0])
            ->andReturn(null);
        /** @var MockeryInterface $servicePlanReposMock */
        $servicePlanReposMock = Mockery::mock(ServicePlanRepository::class);
        /** @var MockeryInterface $serviceOptionReposMock */
        $serviceOptionReposMock = Mockery::mock(ServiceOptionRepository::class);

        // Tests
        /** @var CustomerContractRepository $customerContractReposMock */
        /** @var ServicePlanRepository $servicePlanReposMock */
        /** @var ServiceOptionRepository $serviceOptionReposMock */
        $service = new CustomerService($customerContractReposMock, $servicePlanReposMock, $serviceOptionReposMock);
        $this->assertNull(
            $service->findCustomerContractByUserId(0)
        );
    }

    /**
     * @test
     * @covers ::getServicePlans
     */
    public function getServicePlans(): void
    {
        // Data set
        $expected = [
            new ServicePlan(
                1,
                $this->faker->name()
            ),
        ];

        // Mocks
        /** @var MockeryInterface $customerContractReposMock */
        $customerContractReposMock = Mockery::mock(CustomerContractRepository::class);
        /** @var MockeryInterface $servicePlanReposMock */
        $servicePlanReposMock = Mockery::mock(ServicePlanRepository::class);
        $servicePlanReposMock->shouldReceive('all')
            ->once()
            ->withNoArgs()
            ->andReturn($expected);
        /** @var MockeryInterface $serviceOptionReposMock */
        $serviceOptionReposMock = Mockery::mock(ServiceOptionRepository::class);

        // Tests
        /** @var CustomerContractRepository $customerContractReposMock */
        /** @var ServicePlanRepository $servicePlanReposMock */
        /** @var ServiceOptionRepository $serviceOptionReposMock */
        $service = new CustomerService($customerContractReposMock, $servicePlanReposMock, $serviceOptionReposMock);
        $this->assertEquals($expected, $service->getServicePlans());
    }

    /**
     * @test
     * @covers ::getServiceOptions
     */
    public function getServiceOptions(): void
    {
        // Data set
        $expected = [
            new ServiceOption(
                1,
                $this->faker->name()
            ),
        ];

        // Mocks
        /** @var MockeryInterface $customerContractReposMock */
        $customerContractReposMock = Mockery::mock(CustomerContractRepository::class);
        /** @var MockeryInterface $servicePlanReposMock */
        $servicePlanReposMock = Mockery::mock(ServicePlanRepository::class);
        /** @var MockeryInterface $serviceOptionReposMock */
        $serviceOptionReposMock = Mockery::mock(ServiceOptionRepository::class);
        $serviceOptionReposMock->shouldReceive('all')
            ->once()
            ->withNoArgs()
            ->andReturn($expected);

        // Tests
        /** @var CustomerContractRepository $customerContractReposMock */
        /** @var ServicePlanRepository $servicePlanReposMock */
        /** @var ServiceOptionRepository $serviceOptionReposMock */
        $service = new CustomerService($customerContractReposMock, $servicePlanReposMock, $serviceOptionReposMock);
        $this->assertEquals($expected, $service->getServiceOptions());
    }
}
