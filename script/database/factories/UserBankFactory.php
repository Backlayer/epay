<?php

namespace Database\Factories;

use App\Models\Bank;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserBank>
 */
class UserBankFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "user_id" => User::inRandomOrder()->first()->id ?? null,
            "bank_id" => Bank::inRandomOrder()->first()->id ?? null,
            "data" => [
                "account_number" => fake()->numberBetween(16,16),
                "account_name" => fake()->name(),
                "account_type" => fake()->randomElement(['personal', 'business']),
                "routing_number" => fake()->numberBetween(10,10),
            ],
        ];
    }
}
