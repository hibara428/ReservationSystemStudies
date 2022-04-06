<?php

namespace App\DataProvider;

interface ServicePlanRepositoryInterface
{
    /**
     * Retrieve all data.
     *
     * @return array
     */
    public function all(): array;
}
