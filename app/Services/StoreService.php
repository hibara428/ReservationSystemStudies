<?php

namespace App\Services;

use App\DataProvider\StoreRepositoryInterface;
use App\Domain\Entity\Store;

class StoreService
{
    /** @var StoreRepositoryInterface */
    private $storeRepos;

    /**
     * @param StoreRepositoryInterface $storeRepos
     */
    public function __construct(StoreRepositoryInterface $storeRepos)
    {
        $this->storeRepos = $storeRepos;
    }

    /**
     * Retrieve all stores.
     *
     * @return array
     */
    public function getAllStores(): array
    {
        return $this->storeRepos->all();
    }

    /**
     * Retrieve a store by store ID.
     *
     * @param int $storeId
     * @return Store|null
     */
    public function getStore(int $storeId): ?Store
    {
        return $this->storeRepos->find($storeId);
    }
}
