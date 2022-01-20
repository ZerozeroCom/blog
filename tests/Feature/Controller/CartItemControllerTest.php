<?php

namespace Tests\Feature\Controller;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Passport\Passport;
use Tests\TestCase;

class CartItemControllerTest extends TestCase
{
    use RefreshDatabase;
    private $fakeUser;

    protected function setup(): void{
        parent::setUp();
        $this->fakeUser = User::create(['name' =>'zero',
                                        'email'=>'zero@gmail.com',
                                        'password'=> 1234567]);
        Passport::actingAs($this->fakeUser);
    }
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testStore()
    {
        $cart = Cart::factory()->create();
        $product = Product::factory()->create();

        $response = $this->call(
            'POST',
            'cart-items',
            ['cart_id' => $cart->id,
            'product_id' => $product->id,
            'quantity'=>2]
        );
        $response->assertOk();

        $product = Product::factory()->less()->create();
        $response = $this->call(
            'POST',
            'cart-items',
            ['cart_id' => $cart->id,
            'product_id' => $product->id,
            'quantity'=>10]
        );
        $this->assertEquals($product->title.'數量不足!',$response->getContent());

        $product = Product::factory()->create();
        $response = $this->call(
            'POST',
            'cart-items',
            ['cart_id' => $cart->id,
            'product_id' => $product->id,
            'quantity'=>499900]
        );
        $response->assertStatus(400);
    }


    public function testUpdate(){
        $cartItem = CartItem::factory()->create();
        $response = $this->call(
            'PUT',
            'cart-items/'.$cartItem->id,
            ['quantity'=>1]
        );
        $this->assertEquals('true',$response->getContent());

        $cartItem->refresh();
        $this->assertEquals(1,$cartItem->quantity);
    }

    public function testDestroy(){
        $cartItem = CartItem::factory()->create();
        $response = $this->call(
            'DELETE',
            'cart-items/'.$cartItem->id,
            ['quantity'=>1]
        );
        $response->assertOK();
        $cartItem = CartItem::find($cartItem->id);
        $this->assertNull($cartItem);
    }
}
