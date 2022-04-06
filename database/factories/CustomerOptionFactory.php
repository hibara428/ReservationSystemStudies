<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\ServiceOption;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerOptionFactory extends Factory
{
    /**
     * @return array
     */
    public function definition()
    {
        return [
            'customer_id' => Customer::factory(),
            'service_option_id' => ServiceOption::factory(),
        ];
    }
}
