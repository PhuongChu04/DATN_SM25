<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition(): array
    {
        return [
            'order_code' => 'ORD-' . $this->faker->unique()->numberBetween(10000, 99999),
            'customer_id' => Customer::inRandomOrder()->first()->id ?? Customer::factory(),
            'total_price' => $this->faker->randomFloat(2, 50, 2000),
            'payment_status' => $this->faker->randomElement(['paid', 'unpaid', 'refund']),
            'order_status' => $this->faker->randomElement(['draft', 'packaging', 'completed', 'canceled', 'delivering']),
        ];
    }
}