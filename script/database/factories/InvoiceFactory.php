<?php

namespace Database\Factories;

use App\Models\Currency;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Invoice>
 */
class InvoiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'invoice_no' => Str::random(10),
            'trx' => Str::random(10),
            'charge' => fake()->numberBetween(1, 100),
            'rate' => fake()->numberBetween(1, 100),
            'tax' => fake()->numberBetween(1,50),
            'discount' => fake()->numberBetween(1, 80),
            'total' => fake()->numberBetween(1, 10000),
            'customer_email' => fake()->email(),
            'due_date' => fake()->date(),
            'note' => fake()->paragraph(),
            'paid_at' => fake()->dateTime(),
            'is_paid' => fake()->boolean(),
            'is_sent' => fake()->boolean(),
            'name' => fake()->name(),
            'email' => fake()->email(),
            'owner_id' => User::inRandomOrder()->first()->id ?? User::factory()->create()->id,
            'currency_id' => Currency::inRandomOrder()->first()->id,
            "created_at" => Carbon::parse('01/01/' . date('y'))->addMonths(fake()->numberBetween(1, 12)),
            "updated_at" => Carbon::parse('01/01/' . date('y'))->addMonths(fake()->numberBetween(1, 12)),
        ];
    }

//    public function configure()
//    {
//        return $this->afterCreating(function (Invoice $invoice){
//            return InvoiceItem::factory(fake()->numberBetween(1, 20))->create([
//                'invoice_id' => $invoice->id
//            ]);
//        });
//    }
}
