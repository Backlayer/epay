<?php

namespace Database\Factories;

use App\Models\Invoice;
use App\Models\InvoiceItem;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<InvoiceItem>
 */
class InvoiceItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $amount = fake()->numberBetween(1, 200);
        $quantity = fake()->numberBetween(1, 10);
        return [
            "name" => fake()->colorName(),
            "amount" => $amount,
            "quantity" => $quantity,
            "subtotal" => $amount * $quantity,
            "created_at" => Carbon::parse('01/01/' . date('y'))->addMonths(fake()->numberBetween(1, 12)),
            "updated_at" => Carbon::parse('01/01/' . date('y'))->addMonths(fake()->numberBetween(1, 12)),
        ];
    }
}
