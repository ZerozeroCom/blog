<?php

namespace Database\Factories;
use App\Models\Cart;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CartFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Cart::class;

    public function definition()
    {
        return [
            'id' => $this->faker->randomDigit,
            'user_id' => User::factory(),
        ];
    }
}
