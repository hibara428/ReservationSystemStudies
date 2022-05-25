<?php

namespace Tests\Unit\Domain\Repository;

use App\Domain\Entity\Store;
use App\Domain\Repository\StoreRepository;
use App\Models\Store as ModelsStore;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @coversDefaultClass App\Domain\Repository\StoreRepository
 */
class StoreRepositoryTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @covers ::all
     */
    public function all_hasRecords(): void
    {
        // Data sets
        $storeModels = ModelsStore::factory()->count(3)->create();
        $expected = $storeModels->map(function (ModelsStore $storeModel): Store {
            return new Store(
                $storeModel->id,
                $storeModel->name,
                $storeModel->description,
                $storeModel->num_of_compartment
            );
        })->toArray();

        // Tests
        $storeRepos = new StoreRepository();
        $this->assertEquals(
            $expected,
            $storeRepos->all()
        );
    }

    /**
     * @test
     * @covers ::all
     */
    public function all_emptyRecords(): void
    {
        // Tests
        $storeRepos = new StoreRepository();
        $this->assertEquals(
            [],
            $storeRepos->all()
        );
    }

    /**
     * @test
     * @covers ::find
     */
    public function find_hasRecords(): void
    {
        // Data sets
        $storeModels = ModelsStore::factory()->count(3)->create();
        $expected = $storeModels->map(function (ModelsStore $storeModel): Store {
            return new Store(
                $storeModel->id,
                $storeModel->name,
                $storeModel->description,
                $storeModel->num_of_compartment
            );
        });

        // Tests
        $storeRepos = new StoreRepository();
        $this->assertEquals(
            $expected->get(0),
            $storeRepos->find($storeModels->get(0)->id)
        );
    }

    /**
     * @test
     * @covers ::find
     */
    public function find_emptyRecords(): void
    {
        // Tests
        $storeRepos = new StoreRepository();
        $this->assertNull($storeRepos->find(0));
    }
}
