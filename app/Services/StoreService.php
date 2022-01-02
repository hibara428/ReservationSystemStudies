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
     * @return array|null
     */
    public function getAllStores(): ?array
    {
        return $this->storeRepos->all();
    }

    /**
     * Retrieve a store by store ID.
     *
     * @param int $store_id
     * @return Store|null
     */
    public function getStore(int $store_id): ?Store
    {
        return $this->storeRepos->find($store_id);
    }
}
