<?php

namespace Database\Factories;

use App\Models\Currency;
use App\Models\User;
use App\Models\UserBank;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Date;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payout>
 */
class PayoutFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "user_id" => User::inRandomOrder()->first()->id ?? User::factory()->create()->id,
            "user_bank_id" => UserBank::inRandomOrder()->first()->id ?? UserBank::factory()->create()->id,
            "currency_id" => Currency::inRandomOrder()->first()->id,
            "trx" => \Str::random(10),
            "amount" => fake()->numberBetween(1, 1000),
            "charge" => fake()->numberBetween(1, 200),
            "rate" => fake()->numberBetween(1, 100),
            "comment" => fake()->paragraph(),
            "status" => fake()->randomElement(['pending', 'completed', 'failed']),
            'created_at' => Date::today()->subMonths(8)->addMonths(fake()->numberBetween(1,12)),
            'updated_at' => Date::today()->subMonths(8)->addMonths(fake()->numberBetween(1,12))
        ];
    }
}
