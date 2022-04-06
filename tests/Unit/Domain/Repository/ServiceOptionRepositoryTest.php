<?php

namespace Tests\Unit\Domain\Repository;

use App\Domain\Entity\ServiceOption;
use App\Domain\Repository\ServiceOptionRepository;
use App\Models\ServiceOption as ModelsServiceOption;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;
use Tests\TestCase;

/**
 * @coversDefaultClass App\Domain\Repository\ServiceOptionRepository
 */
class ServiceOptionRepositoryTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @covers ::all
     */
    public function all_hasRecords(): void
    {
        // Data sets
        $serviceOptionModels = ModelsServiceOption::factory()->count(3)->create();
        $expected = $serviceOptionModels->map(function (ModelsServiceOption $serviceOptionModel): ServiceOption {
            return new ServiceOption(
                $serviceOptionModel->id,
                $serviceOptionModel->name,
            );
        })->toArray();

        // Mocks
        /** @var ModelsServiceOption $modelMock */
        $modelMock = Mockery::mock(ModelsServiceOption::class);
        $modelMock->shouldReceive('get')
            ->once()
            ->withNoArgs()
            ->andReturn($serviceOptionModels);

        // Tests
        $serviceOptionRepos = new ServiceOptionRepository($modelMock);
        $this->assertEquals(
            $expected,
            $serviceOptionRepos->all()
        );
    }

    /**
     * @test
     * @covers ::all
     */
    public function all_emptyRecords(): void
    {
        // Mocks
        /** @var ModelsServiceOption $modelMock */
        $modelMock = Mockery::mock(ModelsServiceOption::class);
        $modelMock->shouldReceive('get')
            ->once()
            ->withNoArgs()
            ->andReturn(null);

        // Tests
        $repos = new ServiceOptionRepository($modelMock);
        $this->assertEquals(
            [],
            $repos->all()
        );
    }
}
