<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class LoanFactory extends Factory
{
    public function definition(): array
    {
        return [
            'borrower_name'   => $this->faker->name(),
            'principal_cents' => (string) $this->faker->numberBetween(100000, 2000000), // store as string
        ];
    }
}
