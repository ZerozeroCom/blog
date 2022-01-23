<?php

namespace Database\Factories;

use App\Models\Cart;
use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Order::class;

    public function definition()
    {
        return [
            'user_id' => User::first(),
            'cart_id' => Cart::first()

        ];
    }
}
