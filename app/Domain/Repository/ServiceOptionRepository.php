<?php

namespace App\Domain\Repository;

use App\DataProvider\ServiceOptionRepositoryInterface;
use App\Domain\Entity\ServiceOption;

class ServiceOptionRepository implements ServiceOptionRepositoryInterface
{
    /** @var \App\Models\ServiceOption */
    private $serviceOptionModel;

    /**
     * @param \App\Models\ServiceOption $serviceOptionModel
     */
    public function __construct(\App\Models\ServiceOption $serviceOptionModel)
    {
        $this->serviceOptionModel = $serviceOptionModel;
    }

    /**
     * @inheritDoc
     */
    public function all(): ?array
    {
        $records = $this->serviceOptionModel->get();
        if ($records === null) {
            return null;
        }
        $serviceOption = [];
        foreach ($records as $record) {
            $serviceOption[] = new ServiceOption(
                $record->id,
                $record->name
            );
        }
        return $serviceOption;
    }
}
