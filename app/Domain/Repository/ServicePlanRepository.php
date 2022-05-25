<?php

namespace App\Domain\Repository;

use App\DataProvider\ServicePlanRepositoryInterface;
use App\Domain\Entity\ServicePlan;
use App\Models\ServicePlan as ModelsServicePlan;

class ServicePlanRepository implements ServicePlanRepositoryInterface
{
    /**
     * @inheritDoc
     */
    public function all(): array
    {
        $records = ModelsServicePlan::get();
        if (is_null($records)) {
            return [];
        }
        $servicePlans = [];
        foreach ($records as $record) {
            $servicePlans[] = new ServicePlan(
                $record->id,
                $record->name
            );
        }
        return $servicePlans;
    }
}
