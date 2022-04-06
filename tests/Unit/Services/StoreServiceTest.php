<?php

namespace Tests\Unit;

use App\DataProvider\StoreRepositoryInterface;
use App\Domain\Entity\Store;
use App\Services\StoreService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Mockery;
use Tests\TestCase;

/**
 * @coversDefaultClass App\Services\StoreService
 */
class StoreServiceTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;

    /**
     * @test
     * @covers ::getAllStores
     */
    public function getAllStores(): void
    {
        // Data set
        $expected = [
            new Store(
                $this->faker->randomDigitNotZero(),
                $this->faker->name(),
                $this->faker->text(),
                $this->faker->randomDigit()
            ),
        ];

        // Mocks
        /** @var MockeryInterface $reposMock */
        $reposMock = Mockery::mock(StoreRepositoryInterface::class);
        $reposMock->shouldReceive('all')
            ->once()
            ->withNoArgs()
            ->andReturn($expected);

        // Tests
        /** @var StoreRepositoryInterface $reposMock */
        $service = new StoreService($reposMock);
        $this->assertEquals($expected, $service->getAllStores());
    }

    /**
     * @test
     * @covers ::getStore
     */
    public function getStore_hasRecord(): void
    {
        // Data set
        $expected = new Store(
            $this->faker->randomDigitNotZero(),
            $this->faker->name(),
            $this->faker->text(),
            $this->faker->randomDigit()
        );

        // Mocks
        /** @var MockeryInterface $reposMock */
        $reposMock = Mockery::mock(StoreRepositoryInterface::class);
        $reposMock->shouldReceive('find')
            ->once()
            ->withArgs([0])
            ->andReturn($expected);

        // Tests
        /** @var StoreRepositoryInterface $reposMock */
        $service = new StoreService($reposMock);
        $this->assertEquals(
            $expected,
            $service->getStore(0)
        );
    }

    /**
     * @test
     * @covers ::getStore
     */
    public function getStore_emptyRecord(): void
    {
        // Mocks
        /** @var MockeryInterface $reposMock */
        $reposMock = Mockery::mock(StoreRepositoryInterface::class);
        $reposMock->shouldReceive('find')
            ->once()
            ->withArgs([0])
            ->andReturn(null);

        // Tests
        /** @var StoreRepositoryInterface $reposMock */
        $service = new StoreService($reposMock);
        $this->assertNull($service->getStore(0));
    }
}
