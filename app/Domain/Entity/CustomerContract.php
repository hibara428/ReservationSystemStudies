<?php

namespace App\Domain\Entity;

class CustomerContract
{
    /** @var Customer */
    protected $customer;
    /** @var CustomerPlan */
    protected $customerPlan;
    /** @var CustomerOption[] */
    protected $customerOptions;

    /**
     * @param Customer $customer
     * @param CustomerPlan $customerPlan
     * @param CustomerOption[] $customerOptions
     */
    public function __construct(Customer $customer, CustomerPlan $customerPlan, array $customerOptions)
    {
        $this->customer = $customer;
        $this->customerPlan = $customerPlan;
        $this->customerOptions = $customerOptions;
    }

    /**
     * @return Customer
     */
    public function getCustomer(): Customer
    {
        return $this->customer;
    }

    /**
     * @return CustomerPlan
     */
    public function getCustomerPlan(): CustomerPlan
    {
        return $this->customerPlan;
    }

    /**
     * @return array
     */
    public function getContractedCustomerOptionIds(): array
    {
        $customerOptionIds = [];
        foreach ($this->customerOptions as $customerOption) {
            $customerOptionIds[] = $customerOption->getServiceOptionId();
        }
        return $customerOptionIds;
    }

    /**
     * @param ServiceOption[] $serviceOptions
     * @return CustomerOptionContract[]
     */
    public function getCustomerOptionContracts(array $serviceOptions): array
    {
        $contractOptions = [];
        $contractedOptionIds = $this->getContractedCustomerOptionIds();
        foreach ($serviceOptions as $serviceOption) {
            $isContracted = in_array($serviceOption->getId(), $contractedOptionIds, true);
            $contractOptions[] = new CustomerOptionContract(
                $serviceOption->getId(),
                $serviceOption->getName(),
                $isContracted
            );
        }
        return $contractOptions;
    }
}
