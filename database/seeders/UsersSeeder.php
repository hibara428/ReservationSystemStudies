<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
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
                'email_verified_at' => NULL,
                'password' => Hash::make('hibara428'),
                'remember_token' => NULL,
            ],
            [
                'name' => 'hibara429',
                'email' => 'hibara429@gmail.com',
                'email_verified_at' => NULL,
                'password' => Hash::make('hibara429'),
                'remember_token' => NULL,
            ],
            [
                'name' => 'hibara430',
                'email' => 'hibara430@gmail.com',
                'email_verified_at' => NULL,
                'password' => Hash::make('hibara430'),
                'remember_token' => NULL,
            ]
        ];
        foreach ($params as $param) {
            DB::table('users')->insert($param);
        }
    }
}
