<?php

namespace Tests\Feature;

use App\Domain\Entity\Store;
use App\Models\Store as ModelsStore;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @coversDefaultClass App\Http\Controllers\StoreController
 */
class StoreTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @covers ::__invoke
     */
    public function get200(): void
    {
        $store = ModelsStore::factory()->create();
        $expected = new Store(
            $store->id,
            $store->name,
            $store->description,
            $store->num_of_compartment
        );

        $response = $this->get('/stores/' . $store->id);
        $response->assertStatus(200);
        $response->assertViewIs('store');
        $response->assertViewHasAll([
            'store' => $expected,
        ]);
        $response->assertSeeInOrder(
            [
                $expected->getDescription(),
                $expected->getName(),
                $expected->getNumOfCompartment(),
            ]
        );
    }

    /**
     * @test
     * @covers ::__invoke
     */
    public function get404(): void
    {
        $response = $this->get('/stores/0');
        $response->assertStatus(404);
    }
}
