<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServicePlansSeeder extends Seeder
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
                'name' => 'free',
            ],
            [
                'name' => 'compartment',
            ],
        ];
        foreach ($params as $param) {
            DB::table('service_plans')->insert($param);
        }
    }
}
