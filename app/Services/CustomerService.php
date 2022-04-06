<?php

namespace App\Services;

use App\DataProvider\CustomerContractRepositoryInterface;
use App\DataProvider\ServiceOptionRepositoryInterface;
use App\DataProvider\ServicePlanRepositoryInterface;
use App\Domain\Entity\CustomerContract;

class CustomerService
{
    /** @var CustomerContractRepositoryInterface */
    private $customerContractRepos;
    /** @var ServicePlanRepositoryInterface */
    private $servicePlanRepos;
    /** @var ServiceOptionRepositoryInterface */
    private $serviceOptionRepos;

    /**
     * @param CustomerContractRepositoryInterface $customerContractRepos
     * @param ServicePlanRepositoryInterface $servicePlanRepos
     * @param ServiceOptionRepositoryInterface $serviceOptionRepos
     */
    public function __construct(
        CustomerContractRepositoryInterface $customerContractRepos,
        ServicePlanRepositoryInterface $servicePlanRepos,
        ServiceOptionRepositoryInterface $serviceOptionRepos
    ) {
        $this->customerContractRepos = $customerContractRepos;
        $this->servicePlanRepos = $servicePlanRepos;
        $this->serviceOptionRepos = $serviceOptionRepos;
    }

    /**
     * Find a customer with contracts by user ID.
     *
     * @param int $userId
     * @return CustomerContract|null
     */
    public function findCustomerContractByUserId(int $userId): ?CustomerContract
    {
        return $this->customerContractRepos->findByUserId($userId);
    }

    /**
     * Get service plans.
     *
     * @return array
     */
    public function getServicePlans(): array
    {
        return $this->servicePlanRepos->all();
    }

    /**
     * Get service options.
     *
     * @return array
     */
    public function getServiceOptions(): array
    {
        return $this->serviceOptionRepos->all();
    }
}
