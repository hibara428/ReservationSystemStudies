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
use App\Models\CustomerPlan as ModelsCustomerPlan;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @coversDefaultClass App\Domain\Repository\CustomerContractRepository
 */
class CustomerContractRepositoryTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @covers ::findByUserId
     */
    public function findByUserId_hasRecords(): void
    {
        // Data sets
        $customerModels = ModelsCustomer::factory()->count(3)->create();
        $customerPlanModels = $customerModels->map(function (ModelsCustomer $customerModel) {
            return ModelsCustomerPlan::factory()->create([
                'customer_id' => $customerModel->id,
            ]);
        });
        $customerOptionModels = $customerModels->map(function (ModelsCustomer $customerModel) {
            return ModelsCustomerOption::factory()->create([
                'customer_id' => $customerModel->id,
            ]);
        });
        $expected = new CustomerContract(
            new Customer(
                $customerModels[0]->id,
                $customerModels[0]->name,
                $customerModels[0]->email,
                $customerModels[0]->age,
                $customerModels[0]->user_id
            ),
            new CustomerPlan(
                $customerPlanModels[0]->id,
                $customerPlanModels[0]->customer_id,
                $customerPlanModels[0]->service_plan_id,
                new ServicePlan(
                    $customerPlanModels[0]->servicePlan->id,
                    $customerPlanModels[0]->servicePlan->name,
                )
            ),
            [
                new CustomerOption(
                    $customerOptionModels[0]->id,
                    $customerOptionModels[0]->customer_id,
                    $customerOptionModels[0]->service_option_id
                )
            ]
        );

        // Tests
        $serviceOptionRepos = new CustomerContractRepository();
        $this->assertEquals(
            $expected,
            $serviceOptionRepos->findByUserId($customerModels[0]->user_id)
        );
    }

    /**
     * @test
     * @covers ::findByUserId
     */
    public function findByUserId_emptyRecords(): void
    {
        // Tests
        $customerContractRepos = new CustomerContractRepository();
        $this->assertNull(
            $customerContractRepos->findByUserId(0)
        );
    }
}
