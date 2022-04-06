<?php

namespace Tests\Unit\Domain\Repository;

use App\Domain\Entity\Customer;
use App\Domain\Entity\CustomerContract;
use App\Domain\Entity\CustomerOption;
use App\Domain\Entity\CustomerPlan;
use App\Domain\Entity\ServicePlan;
use App\Domain\Repository\CustomerContractRepository;
use App\Models\Customer as ModelsCustomer;
use App\Models\CustomerOption as ModelsCustomerOption;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;
use Tests\TestCase;

/**
 * @coversDefaultClass App\Domain\Repository\CustomerContractRepository
 */
class CustomerContractRepositoryTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @covers ::all
     */
    public function all_hasRecords(): void
    {
        // Data sets
        $customerModels = ModelsCustomer::factory()->count(3)->create();
        $expected = $customerModels->map(function (ModelsCustomer $customerModel): CustomerContract {
            return new CustomerContract(
                new Customer(
                    $customerModel->id,
                    $customerModel->name,
                    $customerModel->email,
                    $customerModel->age,
                    $customerModel->user_id,

                ),
                new CustomerPlan(
                    $customerModel->customerPlan->id,
                    $customerModel->customerPlan->customer_id,
                    $customerModel->customerPlan->service_plan_id,
                    new ServicePlan(
                        $customerModel->customerPlan->servicePlan->id,
                        $customerModel->customerPlan->servicePlan->name,
                    )
                ),
                $customerModel->customerOptions->map(function (ModelsCustomerOption $customerOptionModel): CustomerOption {
                    return new CustomerOption(
                        $customerOptionModel->id,
                        $customerOptionModel->customer_id,
                        $customerOptionModel->service_option_id
                    );
                })->toArray()
            );
        })->toArray();

        // Mocks
        /** @var ModelsCustomer $modelMock */
        $modelMock = Mockery::mock(ModelsCustomer::class);
        $modelMock->shouldReceive('first')
            ->once()
            ->withNoArgs()
            ->andReturn($customerModels);

        // Tests
        $serviceOptionRepos = new CustomerContractRepository($modelMock);
        $this->assertEquals(
            $expected,
            $serviceOptionRepos->findByUserId(0)
        );
    }

    /**
     * @test
     * @covers ::all
     */
    public function findByUserId_emptyRecords(): void
    {
        // Mocks
        /** @var ModelsCustomer $modelMock */
        $modelMock = Mockery::mock(ModelsCustomer::class);
        $modelMock->shouldReceive('first')
            ->once()
            ->withNoArgs()
            ->andReturn(null);

        // Tests
        $customerContractRepos = new CustomerContractRepository($modelMock);
        $this->assertNull(
            $customerContractRepos->findByUserId(0)
        );
    }
}
