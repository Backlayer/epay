<?php

namespace Database\Factories;

use App\Models\Currency;
use App\Models\UserBank;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->safeEmail(),
            'phone' => fake()->phoneNumber(),
            'avatar' => 'https://avatars.dicebear.com/api/adventurer/avatar.png',
            'username' => fake()->userName(),
            'role' => 'user',
            'wallet' => fake()->numberBetween(1,500),
            'status' => 1,
            'meta' => [
                'business_name' => fake()->company()
            ],
            'currency_id' => Currency::inRandomOrder()->first()->id ?? null,
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }

    public function configure()
    {
        return $this->afterCreating(function ($model){
            UserBank::factory()->create([
                'user_id' => $model->id
            ]);
        });
    }
}
