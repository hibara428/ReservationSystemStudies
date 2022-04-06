<?php

namespace Tests\Feature;

use App\Domain\Entity\Store;
use App\Models\Store as ModelsStore;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @coversDefaultClass App\Http\Controllers\IndexController
 */
class IndexTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @covers ::__invoke
     */
    public function get200(): void
    {
        $expected = ModelsStore::factory()
            ->count(3)
            ->create()
            ->map(function (ModelsStore $store) {
                return new Store(
                    $store->id,
                    $store->name,
                    $store->description,
                    $store->num_of_compartment
                );
            });


        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertViewIs('index');
        $response->assertViewHasAll([
            'stores' => $expected->toArray(),
        ]);
        $response->assertSeeInOrder(
            $expected->map(function (Store $store): string {
                return $store->getName();
            })->toArray()
        );
    }
}
