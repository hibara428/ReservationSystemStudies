<?php

namespace App\DataProvider;

interface ServiceOptionRepositoryInterface
{
    /**
     * Retrieve all data.
     *
     * @return array|null
     */
    public function all(): ?array;
}
