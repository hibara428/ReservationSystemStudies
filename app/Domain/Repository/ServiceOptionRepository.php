<?php

namespace App\Domain\Repository;

use App\DataProvider\ServiceOptionRepositoryInterface;
use App\Domain\Entity\ServiceOption;
use App\Models\ServiceOption as ModelsServiceOption;

class ServiceOptionRepository implements ServiceOptionRepositoryInterface
{
    /** @var ModelsServiceOption */
    private $serviceOption;

    /**
     * @param ModelsServiceOption $serviceOption
     */
    public function __construct(ModelsServiceOption $serviceOption)
    {
        $this->serviceOption = $serviceOption;
    }

    /**
     * @inheritDoc
     */
    public function all(): array
    {
        $records = $this->serviceOption->get();
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
