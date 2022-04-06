<?php

namespace Tests\Unit\Models;

use App\Models\CustomerOption;
use App\Models\ServiceOption;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @coversDefaultClass App\Models\CustomerOption
 */
class CustomerOptionTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @covers ::serviceOption
     */
    public function serviceOption_hasRecords(): void
    {
        $serviceOption = ServiceOption::factory()->create();
        $customerOption = CustomerOption::factory([
            'service_option_id' => $serviceOption->id,
        ])->create();

        $this->assertEquals(
            $serviceOption->toArray(),
            CustomerOption::find($customerOption->id)
                ->serviceOption
                ->toArray(),
        );
    }
}
