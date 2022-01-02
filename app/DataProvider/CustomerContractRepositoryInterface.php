<?php

namespace App\DataProvider;

use App\Domain\Entity\CustomerContract;

interface CustomerContractRepositoryInterface
{
    /**
     * Find a CustomerContract by user ID.
     *
     * @param int $userId
     * @return CustomerContract|null
     */
    public function findByUserId(int $userId): ?CustomerContract;
}
