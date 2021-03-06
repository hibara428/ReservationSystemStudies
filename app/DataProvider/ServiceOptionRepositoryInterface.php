<?php

namespace App\DataProvider;

interface ServiceOptionRepositoryInterface
{
    /**
     * Retrieve all data.
     *
     * @return array
     */
    public function all(): array;
}
