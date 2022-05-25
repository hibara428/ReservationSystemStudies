<?php

namespace App\Domain\Repository;

use App\DataProvider\ServiceOptionRepositoryInterface;
use App\Domain\Entity\ServiceOption;
use App\Models\ServiceOption as ModelsServiceOption;

class ServiceOptionRepository implements ServiceOptionRepositoryInterface
{
    /**
     * @inheritDoc
     */
    public function all(): array
    {
        $records = ModelsServiceOption::get();
        if (is_null($records)) {
            return [];
        }

        $serviceOptions = [];
        foreach ($records as $record) {
            $serviceOptions[] = new ServiceOption(
                $record->id,
                $record->name
            );
        }
        return $serviceOptions;
    }
}
