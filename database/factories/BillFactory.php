<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

class BillFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'bill_no' => $this->faker->unique()->randomNumber(5),
            'bill_month' => $this->faker->numberBetween(1, 12),
            'bill_year' => $this->faker->numberBetween(2000, 2022),
            'bill_date' => $this->faker->dateTimeBetween('-1 years', 'now'),
            'bill_amount' => $this->faker->randomFloat(2, 0, 100000),
            'bill_status' => $this->faker->randomElement(['paid', 'unpaid']),
            'customer_id' => Customer::factory()->create()->id,
        ];
    }
}
