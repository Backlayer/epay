<?php

namespace Database\Factories;

use App\Models\Currency;
use App\Models\Gateway;
use App\Models\User;
use App\Models\Website;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class WebOrderFactory extends Factory
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
            "website_id" => Website::inRandomOrder()->first()->id ?? Website::factory()->create()->id,
            "currency_id" => Currency::inRandomOrder()->first()->id,
            "gateway_id" => Gateway::inRandomOrder()->first()->id,
            "trx" => \Str::random(10),
            "reference_code" => "REF_".\Str::random(10),
            "amount" => fake()->numberBetween(1, 1000),
            "charge" => fake()->numberBetween(1, 100),
            "rate" => fake()->numberBetween(1, 100),
            "quantity" => fake()->numberBetween(1, 10),
            "paid_at" => fake()->dateTime(),
            "payment_status" => fake()->boolean(),
            "meta" => [
                "foo"=> "bar"
            ],
            "created_at" => Carbon::parse('01/01/' . date('y'))->addMonths(fake()->numberBetween(1, 12)),
            "updated_at" => Carbon::parse('01/01/' . date('y'))->addMonths(fake()->numberBetween(1, 12)),
        ];
    }
}
