<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\ServicePlan;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerPlanFactory extends Factory
{
    /**
     * @return array
     */
    public function definition()
    {
        return [
            'customer_id' => Customer::factory(),
            'service_plan_id' => ServicePlan::factory(),
        ];
    }
}
