<?php

namespace Database\Seeders;

use App\Models\Bill;
use App\Models\Customer;
use App\Models\User;
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

        User::factory()->create(['email' => 'admin@example.com', 'name' => 'Admin']);
        User::factory(25)->create();

        Customer::factory()->create(['email' => 'customer@example.com', 'name' => 'Mr. Customer']);
        Customer::factory(35)->create();
        Bill::factory(100)->create();
    }
}
