<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerOptionsSeeder extends Seeder
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
                'service_option_id' => 1,
            ],
            [
                'customer_id' => 1,
                'service_option_id' => 2,
            ],
            [
                'customer_id' => 1,
                'service_option_id' => 3,
            ],
            [
                'customer_id' => 2,
                'service_option_id' => 1,
            ],
            [
                'customer_id' => 3,
                'service_option_id' => 2,
            ],
            [
                'customer_id' => 3,
                'service_option_id' => 3,
            ]
        ];
        foreach ($params as $param) {
            DB::table('customer_options')->insert($param);
        }
    }
}
