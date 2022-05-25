<?php

namespace Tests\Unit\Domain\Repository;

use App\Domain\Entity\ServiceOption;
use App\Domain\Repository\ServiceOptionRepository;
use App\Models\ServiceOption as ModelsServiceOption;
use Illuminate\Foundation\Testing\RefreshDatabase;
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

        // Tests
        $serviceOptionRepos = new ServiceOptionRepository();
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
        // Tests
        $repos = new ServiceOptionRepository();
        $this->assertEquals(
            [],
            $repos->all()
        );
    }
}
