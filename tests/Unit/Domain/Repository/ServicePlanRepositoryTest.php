<?php

namespace Tests\Unit\Domain\Repository;

use App\Domain\Entity\ServicePlan;
use App\Domain\Repository\ServicePlanRepository;
use App\Models\ServicePlan as ModelsServicePlan;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @coversDefaultClass App\Domain\Repository\ServicePlanRepository
 */
class ServicePlanRepositoryTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @covers ::all
     */
    public function all_hasRecords(): void
    {
        // Data sets
        $servicePlanModels = ModelsServicePlan::factory()->count(3)->create();
        $expected = $servicePlanModels->map(function (ModelsServicePlan $serviceOptionModel): ServicePlan {
            return new ServicePlan(
                $serviceOptionModel->id,
                $serviceOptionModel->name,
            );
        })->toArray();

        // Tests
        $repos = new ServicePlanRepository();
        $this->assertEquals(
            $expected,
            $repos->all()
        );
    }

    /**
     * @test
     * @covers ::all
     */
    public function all_emptyRecords(): void
    {
        // Tests
        $repos = new ServicePlanRepository();
        $this->assertEquals(
            [],
            $repos->all()
        );
    }
}
