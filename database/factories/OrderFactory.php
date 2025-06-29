<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\user;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition(): array
    {
        return [
            'order_code' => 'ORD-' . $this->faker->unique()->numberBetween(10000, 99999),
            'user_id' => user::inRandomOrder()->first()->id ?? User::factory(),
            'total_price' => $this->faker->randomFloat(2, 100000, 200000),
            'payment_status' => $this->faker->randomElement(['paid', 'unpaid', 'refund']),
            'order_status' => $this->faker->randomElement(['confirming', 'pending', 'processing', 'shipping', 'delivered']),
        ];
    }
}