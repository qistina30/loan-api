<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Loan;

class RepaymentFactory extends Factory
{
    public function definition(): array
    {
        return [
            'loan_id'      => Loan::factory(), // auto-create a loan if not provided
            'paid_at'      => $this->faker->date(),
            'amount_cents' => (string) $this->faker->numberBetween(10000, 500000), // store as string
        ];
    }
}
