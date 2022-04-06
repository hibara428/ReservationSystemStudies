<?php

namespace App\Domain\Repository;

use App\DataProvider\CustomerContractRepositoryInterface;
use App\Domain\Entity\Customer;
use App\Domain\Entity\CustomerContract;
use App\Domain\Entity\CustomerOption;
use App\Domain\Entity\CustomerPlan;
use App\Domain\Entity\ServicePlan;
use App\Models\Customer as ModelsCustomer;
use App\Models\CustomerOption as ModelsCustomerOption;

class CustomerContractRepository implements CustomerContractRepositoryInterface
{
    /** @var ModelsCustomer */
    private $customer;

    /**
     * @param ModelsCustomer $customer
     */
    public function __construct(ModelsCustomer $customer)
    {
        $this->customer = $customer;
    }

    /**
     * @inheritDoc
     */
    public function findByUserId(int $userId): ?CustomerContract
    {
        $record = $this->customer->with([
            'customerPlan.servicePlan',
            'customerOptions.serviceOption'
        ])
            ->where('user_id', $userId)
            ->first();
        if (is_null($record)) {
            return null;
        }

        return new CustomerContract(
            new Customer(
                $record->id,
                $record->name,
                $record->email,
                $record->age,
                $record->user_id
            ),
            new CustomerPlan(
                $record->customerPlan->id,
                $record->customerPlan->customer_id,
                $record->customerPlan->service_plan_id
            ),
            $record->customerOptions->map(function (ModelsCustomerOption $customerOption): CustomerOption {
                return new CustomerOption(
                    $customerOption->id,
                    $customerOption->customer_id,
                    $customerOption->service_option_id
                );
            })->toArray(),
        );
    }
}
