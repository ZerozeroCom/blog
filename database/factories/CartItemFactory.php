<?php

namespace Database\Factories;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;


class CartItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = CartItem::class;
    public function definition()
    {
        return [
            'cart_id' => Cart::factory(),
            'product_id' => Product::factory(),
            'quantity'=>$this->faker->numberBetween(1,10)
        ];
    }
}
