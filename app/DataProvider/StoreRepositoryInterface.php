<?php

namespace App\DataProvider;

use App\Domain\Entity\Store;

interface StoreRepositoryInterface
{
    /**
     * Retrieve all data.
     *
     * @return array
     */
    public function all(): array;

    /**
     * Find a store.
     *
     * @param int $id
     * @return Store|null
     */
    public function find(int $id): ?Store;
}
