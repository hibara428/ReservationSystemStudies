<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomersSeeder extends Seeder
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
                'name' => 'hibara428',
                'email' => 'hibara428@gmail.com',
                'age' => 32,
                'user_id' => 1,
            ],
            [
                'name' => 'hibara429',
                'email' => 'hibara429@gmail.com',
                'age' => 33,
                'user_id' => 2,
            ],
            [
                'name' => 'hibara430',
                'email' => 'hibara430@gmail.com',
                'age' => 34,
                'user_id' => 3,
            ]
        ];
        foreach ($params as $param) {
            DB::table('customers')->insert($param);
        }
    }
}
