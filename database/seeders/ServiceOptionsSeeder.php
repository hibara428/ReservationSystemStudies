<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceOptionsSeeder extends Seeder
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
                'name' => 'registration',
            ],
            [
                'name' => 'private_post',
            ],
            [
                'name' => 'private_locker',
            ],
        ];
        foreach ($params as $param) {
            DB::table('service_options')->insert($param);
        }
    }
}
