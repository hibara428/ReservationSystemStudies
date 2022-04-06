<?php

namespace Tests\Feature;

use App\Domain\Entity\Customer;
use App\Domain\Entity\CustomerPlan;
use App\Domain\Entity\ServiceOption;
use App\Models\Customer as ModelsCustomer;
use App\Models\CustomerOption as ModelsCustomerOption;
use App\Models\CustomerPlan as ModelsCustomerPlan;
use App\Models\ServiceOption as ModelsServiceOption;
use App\Models\ServicePlan as ModelsServicePlan;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @coversDefaultClass App\Http\Controllers\HomeController
 */
class HomeTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @covers ::__invoke
     */
    public function get200(): void
    {
        // Data sets
        /** @var Authenticatable $user */
        $user = User::factory()->create();
        $customer = ModelsCustomer::factory([
            'user_id' => $user->id,
        ])->create();
        $servicePlans = ModelsServicePlan::factory()
            ->count(3)
            ->create();
        $serviceOptions = ModelsServiceOption::factory()
            ->count(3)
            ->create();
        $customerPlan = ModelsCustomerPlan::factory([
            'customer_id' => $customer->id,
            'service_plan_id' => $servicePlans->get(0)->id,
        ])->create();
        $serviceOptions->each(function (ModelsServiceOption $serviceOption) use ($customer) {
            ModelsCustomerOption::factory([
                'customer_id' => $customer->id,
                'service_option_id' => $serviceOption->id,
            ])->create();
        });
        $contractedServiceOptionIds = $serviceOptions
            ->pluck('id')
            ->toArray();

        // Tests
        $response = $this
            ->actingAs($user)
            ->get('/home');
        $response->assertStatus(200);
        $response->assertViewIs('home');
        $response->assertViewHasAll([
            'customer' => new Customer(
                $customer->id,
                $customer->name,
                $customer->email,
                $customer->age,
                $customer->user_id
            ),
            'customerPlan' => new CustomerPlan(
                $customerPlan->id,
                $customerPlan->customer_id,
                $customerPlan->service_plan_id
            ),
            'servicePlans' => $servicePlans->mapWithKeys(function (ModelsServicePlan $servicePlan): array {
                return [
                    $servicePlan->id => $servicePlan->name,
                ];
            })->toArray(),
            'serviceOptions' => $serviceOptions->map(function (ModelsServiceOption $serviceOption): ServiceOption {
                return new ServiceOption(
                    $serviceOption->id,
                    $serviceOption->name
                );
            })->toArray(),
            'contractedServiceOptionIds' => $contractedServiceOptionIds,
        ]);
        $response->assertSeeInOrder(
            [
                $customer->id,
                $customer->name,
                $customer->email,
                $customer->age,
            ]
        );
    }

    /**
     * @test
     * @covers ::__invoke
     */
    public function get400(): void
    {
        /** @var Authenticatable $user */
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->get('/home');
        $response->assertStatus(400);
    }
}
