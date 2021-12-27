<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UsersSeeder::class,
            StoresSeeder::class,
            ServicePlansSeeder::class,
            ServiceOptionsSeeder::class,
            CustomersSeeder::class,
            CustomerPlansSeeder::class,
            CustomerOptionsSeeder::class,
        ]);
    }
}
