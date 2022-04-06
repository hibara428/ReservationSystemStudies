<?php

namespace App\Domain\Repository;

use App\DataProvider\ServicePlanRepositoryInterface;
use App\Domain\Entity\ServicePlan;
use App\Models\ServicePlan as ModelsServicePlan;

class ServicePlanRepository implements ServicePlanRepositoryInterface
{
    /** @var ModelsServicePlan */
    private $modelsServicePlan;

    /**
     * @param ModelsServicePlan $modelsServicePlan
     */
    public function __construct(ModelsServicePlan $modelsServicePlan)
    {
        $this->modelsServicePlan = $modelsServicePlan;
    }

    /**
     * @inheritDoc
     */
    public function all(): array
    {
        $records = $this->modelsServicePlan->get();
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
