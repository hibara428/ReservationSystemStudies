<?php

namespace Tests\Unit\Models;

use App\Models\Customer;
use App\Models\CustomerOption;
use App\Models\CustomerPlan;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @coversDefaultClass App\Models\Customer
 */
class CustomerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @covers ::customerPlan
     */
    public function customerPlan_hasRecords(): void
    {
        $customer = Customer::factory()->create();
        $customerPlan = CustomerPlan::factory([
            'customer_id' => $customer->id,
        ])->create();

        $this->assertEquals(
            $customerPlan->toArray(),
            Customer::find($customer->id)
                ->customerPlan
                ->toArray(),
        );
    }

    /**
     * @test
     * @covers ::customerOptions
     */
    public function customerOptions_hasRecords(): void
    {
        $customer = Customer::factory()->create();
        $customerOptions = CustomerOption::factory([
            'customer_id' => $customer->id,
        ])
            ->count(3)
            ->create();

        $this->assertEquals(
            $customerOptions->toArray(),
            Customer::find($customer->id)
                ->customerOptions
                ->toArray(),
        );
    }
}
