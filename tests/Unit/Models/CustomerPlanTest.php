<?php

namespace Tests\Unit\Models;

use App\Models\CustomerPlan;
use App\Models\ServicePlan;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @coversDefaultClass App\Models\CustomerPlan
 */
class CustomerPlanTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @covers ::servicePlan
     */
    public function servicePlan_hasRecords(): void
    {
        $customerPlan = CustomerPlan::factory()->create();

        $this->assertEquals(
            ServicePlan::find($customerPlan->service_plan_id)->toArray(),
            customerPlan::find($customerPlan->id)
                ->servicePlan
                ->toArray(),
        );
    }
}
