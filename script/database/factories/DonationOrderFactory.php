<?php

namespace Database\Factories;

use App\Models\Currency;
use App\Models\Donation;
use App\Models\Gateway;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class DonationOrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "invoice_no" => \Str::random(10),
            "trx" => Str::random(10),
            "amount" => fake()->numberBetween(1, 150),
            "charge" => fake()->numberBetween(1, 50),
            "rate" => fake()->numberBetween(1, 50),
            "is_anonymous" => fake()->boolean(),
            "status" => fake()->boolean(),
            "name" => fake()->name(),
            "email" => fake()->name(),
            "donor_id" => User::inRandomOrder()->first()->id ?? User::factory()->create()->id,
            "user_id" => User::inRandomOrder()->first()->id ?? User::factory()->create()->id,
            "gateway_id" => Gateway::inRandomOrder()->first()->id,
            "currency_id" => Currency::inRandomOrder()->first()->id,
            "donation_id" => Donation::inRandomOrder()->first()->id ?? Donation::factory()->create(),
            "created_at" => Carbon::parse('01/01/' . date('y'))->addMonths(fake()->numberBetween(1, 12)),
            "updated_at" => Carbon::parse('01/01/' . date('y'))->addMonths(fake()->numberBetween(1, 12)),
        ];
    }
}
