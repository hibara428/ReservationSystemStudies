<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerPlansSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $params = [
            [
                'customer_id' => 1,
                'service_plan_id' => 1,
            ],
            [
                'customer_id' => 2,
                'service_plan_id' => 1,
            ],
            [
                'customer_id' => 3,
                'service_plan_id' => 2,
            ]
        ];
        foreach ($params as $param) {
            DB::table('customer_plans')->insert($param);
        }
    }
}
