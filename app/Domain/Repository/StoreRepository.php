<?php

namespace App\Domain\Repository;

use App\DataProvider\StoreRepositoryInterface;
use App\Domain\Entity\Store;

class StoreRepository implements StoreRepositoryInterface
{
    /** @var \App\Models\Store */
    private $storeModel;

    /**
     * @param \App\Models\Store $storeModel
     */
    public function __construct(\App\Models\Store $storeModel)
    {
        $this->storeModel = $storeModel;
    }

    /**
     * @inheritDoc
     */
    public function all(): ?array
    {
        $records = $this->storeModel->get();
        if ($records === null) {
            return null;
        }
        $stores = [];
        foreach ($records as $record) {
            $stores[] = new Store(
                $record->id,
                $record->name,
                $record->description,
                $record->num_of_compartment
            );
        }
        return $stores;
    }

    /**
     * @inheritDoc
     */
    public function find(int $id): ?Store
    {
        $record = $this->storeModel->find($id);
        if ($record === null) {
            return null;
        }
        return new Store(
            $record->id,
            $record->name,
            $record->description,
            $record->num_of_compartment
        );
    }
}
