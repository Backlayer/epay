<?php

namespace Database\Factories;

use App\Models\Currency;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Donation>
 */
class DonationFactory extends Factory
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
            "title" => fake()->colorName(),
            "amount" => fake()->numberBetween(1, 150),
            "image" => "https://fakeimg.pl/350x200/",
            "description" => fake()->paragraph(),
            "status" => 1,
            "created_at" => Carbon::parse('01/01/' . date('y'))->addMonths(fake()->numberBetween(1, 12)),
            "updated_at" => Carbon::parse('01/01/' . date('y'))->addMonths(fake()->numberBetween(1, 12)),
        ];
    }
}
