<?php

namespace Database\Factories;

use App\Models\Currency;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Date;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Moneyrequest>
 */
class MoneyrequestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "sender_id" => User::inRandomOrder()->first()->id ?? User::factory()->create()->id,
            "receiver_id" => User::inRandomOrder()->first()->id ?? User::factory()->create()->id,
            "request_currency_id" => Currency::inRandomOrder()->first()->id,
            "approved_currency_id" => Currency::inRandomOrder()->first()->id,
            "amount" => fake()->numberBetween(1, 1000),
            "charge" => fake()->numberBetween(1, 200),
            "rate" => fake()->numberBetween(1, 100),
            "status" => fake()->boolean(),
            'created_at' => Date::today()->subMonths(8)->addMonths(fake()->numberBetween(1,12)),
            'updated_at' => Date::today()->subMonths(8)->addMonths(fake()->numberBetween(1,12))
        ];
    }
}
