<?php

namespace App\Domain\Repository;

use App\DataProvider\StoreRepositoryInterface;
use App\Domain\Entity\Store;
use App\Models\Store as ModelsStore;

class StoreRepository implements StoreRepositoryInterface
{
    /**
     * @inheritDoc
     */
    public function all(): array
    {
        $records = ModelsStore::get();
        if (is_null($records)) {
            return [];
        }
        return $records->map(function (ModelsStore $record): Store {
            return new Store(
                $record->id,
                $record->name,
                $record->description,
                $record->num_of_compartment
            );
        })->toArray();
    }

    /**
     * @inheritDoc
     */
    public function find(int $id): ?Store
    {
        $record = ModelsStore::find($id);
        if (is_null($record)) {
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
