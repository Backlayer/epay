<?php

namespace Database\Factories;

use App\Models\Currency;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "invoice_no" => Str::random(10),
            "user_id" => User::inRandomOrder()->first()->id ?? User::factory()->create()->id,
            "currency_id" => Currency::inRandomOrder()->first()->id ?? Currency::factory()->create()->id,
            "amount" => fake()->numberBetween(200,500),
            "rate" => fake()->numberBetween(1, 100),
            "charge" => fake()->numberBetween(1,200),
            "reason" => fake()->paragraph(),
            "type" => fake()->randomElement(['debit', 'credit']),
            "name" => fake()->name(),
            "email" => fake()->email(),
            'created_at' => Date::today()->subMonths(8)->addMonths(fake()->numberBetween(1,12)),
            'updated_at' => Date::today()->subMonths(8)->addMonths(fake()->numberBetween(1,12))
        ];
    }
}
