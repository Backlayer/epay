<?php

namespace Database\Factories;

use App\Models\Currency;
use App\Models\Gateway;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Qrpayment>
 */
class QrpaymentFactory extends Factory
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
            "seller_id" => User::inRandomOrder()->first()->id ?? User::factory()->create()->id,
            "gateway_id" => Gateway::inRandomOrder()->first()->id ,
            "currency_id" => Currency::inRandomOrder()->first()->id ,
            "trx" => Str::random(10),
            "amount" => fake()->numberBetween(1, 1000),
            "charge" => fake()->numberBetween(1, 100),
            "rate" => fake()->numberBetween(1, 100),
            "name" => fake()->name(),
            "email" => fake()->email(),
            "comment" => fake()->paragraph(),
            "created_at" => Carbon::parse('01/01/'.\date('y'))->addMonths(fake()->numberBetween(1, 12)),
            "updated_at" => Carbon::parse('01/01/'.\date('y'))->addMonths(fake()->numberBetween(1, 12)),
        ];
    }
}
