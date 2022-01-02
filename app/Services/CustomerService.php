<?php

namespace App\Services;

use App\DataProvider\CustomerContractRepositoryInterface;
use App\DataProvider\ServiceOptionRepositoryInterface;
use App\Domain\Entity\CustomerContract;

class CustomerService
{
    /** @var CustomerContractRepositoryInterface */
    private $customerContractRepos;
    /** @var ServiceOptionRepositoryInterface */
    private $serviceOptionRepos;

    /**
     * @param CustomerContractRepositoryInterface $customerContractRepos
     * @param ServiceOptionRepositoryInterface $serviceOptionRepos
     */
    public function __construct(CustomerContractRepositoryInterface $customerContractRepos, ServiceOptionRepositoryInterface $serviceOptionRepos)
    {
        $this->customerContractRepos = $customerContractRepos;
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
     * Retrieve all service options.
     *
     * @return array|null
     */
    public function retrieveServiceOptions(): ?array
    {
        return $this->serviceOptionRepos->all();
    }
}
