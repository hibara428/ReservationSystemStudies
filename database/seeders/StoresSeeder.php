<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StoresSeeder extends Seeder
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
                'name' => 'Store A',
                'description' => 'The store in A!',
                'num_of_compartment' => 32,
            ],
            [
                'name' => 'Store B',
                'description' => 'The store in B!',
                'num_of_compartment' => 16,
            ],
        ];
        foreach ($params as $param) {
            DB::table('stores')->insert($param);
        }
    }
}
