<?php

namespace Database\Factories;

use App\Models\Currency;
use App\Models\SingleCharge;
use App\Models\SingleChargeOrder;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Str;
use function date;

/**
 * @extends Factory<SingleCharge>
 */
class SingleChargeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "uuid" => Str::uuid(),
            "user_id" => User::factory()->create()->id,
            "currency_id" => Currency::inRandomOrder()->first()->id,
            "title" => fake()->colorName() . 'Payment',
            "amount" => fake()->numberBetween(1, 1000),
            "status" => true,
            "created_at" => Carbon::parse('01/01/' . date('y'))->addMonths(fake()->numberBetween(1, 12)),
            "updated_at" => Carbon::parse('01/01/' . date('y'))->addMonths(fake()->numberBetween(1, 12)),
        ];
    }
}
