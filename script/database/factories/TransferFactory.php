<?php

namespace Database\Factories;

use App\Models\Currency;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Date;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transfer>
 */
class TransferFactory extends Factory
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
            "currency_id" => Currency::inRandomOrder()->first()->id,
            "email" => fake()->email(),
            "trx" => \Str::random(10),
            "amount" => fake()->numberBetween(1, 1000),
            "charge" => fake()->numberBetween(1, 100),
            "rate" => fake()->numberBetween(1, 100),
            "is_beneficiary" => fake()->boolean(),
            "status" => fake()->boolean(),
            'created_at' => Date::today()->subMonths(8)->addMonths(fake()->numberBetween(1,12)),
            'updated_at' => Date::today()->subMonths(8)->addMonths(fake()->numberBetween(1,12))
        ];
    }
}
