<?php

namespace App\Domain\Repository;

use App\DataProvider\CustomerContractRepositoryInterface;
use App\Domain\Entity\Customer;
use App\Domain\Entity\CustomerContract;
use App\Domain\Entity\CustomerOption;
use App\Domain\Entity\CustomerPlan;
use App\Domain\Entity\ServicePlan;
use Illuminate\Support\Facades\DB;

class CustomerContractRepository implements CustomerContractRepositoryInterface
{
    /** @var \App\Models\Customer */
    private $customerModel;

    /**
     * @param \App\Models\Customer $customerModel
     */
    public function __construct(\App\Models\Customer $customerModel)
    {
        $this->customerModel = $customerModel;
    }

    /**
     * @inheritDoc
     */
    public function findByUserId(int $userId): ?CustomerContract
    {
        $record = $this->customerModel->with([
            'customerPlan.servicePlan',
            'customerOptions.serviceOption'
        ])
            ->where('user_id', $userId)
            ->first();

        $customer = new Customer(
            $record->id,
            $record->name,
            $record->email,
            $record->age,
            $record->user_id
        );
        $customerPlan = new CustomerPlan(
            $record->customerPlan->id,
            $record->customerPlan->customer_id,
            $record->customerPlan->service_plan_id,
            new ServicePlan(
                $record->customerPlan->servicePlan->id,
                $record->customerPlan->servicePlan->name,
            )
        );
        $customerOptions = [];
        foreach ($record->customerOptions as $customerOption) {
            $customerOptions[] = new CustomerOption(
                $customerOption->id,
                $customerOption->customer_id,
                $customerOption->service_option_id
            );
        }
        return new CustomerContract(
            $customer,
            $customerPlan,
            $customerOptions
        );
    }
}
