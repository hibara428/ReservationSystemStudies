<?php

namespace Tests\Unit\Domain\Repository;

use App\Domain\Entity\ServicePlan;
use App\Domain\Repository\ServicePlanRepository;
use App\Models\ServicePlan as ModelsServicePlan;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;
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

        // Mocks
        /** @var ModelsServicePlan $modelMock */
        $modelMock = Mockery::mock(ModelsServicePlan::class);
        $modelMock->shouldReceive('get')
            ->once()
            ->withNoArgs()
            ->andReturn($servicePlanModels);

        // Tests
        $repos = new ServicePlanRepository($modelMock);
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
        // Mocks
        /** @var ModelsServicePlan $modelMock */
        $modelMock = Mockery::mock(ModelsServicePlan::class);
        $modelMock->shouldReceive('get')
            ->once()
            ->withNoArgs()
            ->andReturn(null);

        // Tests
        $repos = new ServicePlanRepository($modelMock);
        $this->assertEquals(
            [],
            $repos->all()
        );
    }
}
