<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/*  https://laravel.com/docs/8.x/database#database-transactions

*/

class Cart extends Model
{
    use HasFactory;
    protected $guarded = [''];
    private $rate =1;
    public function cartItems(){
        return $this->hasMany(CartItem::class);

    }

    public function user(){
        return $this->belongsTo(User::class);

    }
    public function order(){
        return $this->hasOne(Order::class);

    }
    public function checkout(){
//        $result =DB::transaction(function () {
            DB::beginTransaction();
            try{
                foreach($this->cartItems as $cartItem){
                    $product = $cartItem->product;
                    if(!$product->checkQuantity($cartItem->quantity)){
                        return $product->title.'數量不足!!';
                    }
                }


                $order =$this->order()->create([
                    'user_id' => $this->user_id
                ]);
                if ($this->user->level == 2){
                    $this->rate = 0.8;
                }
 //               throw new Exception('123456');
                foreach($this->cartItems as $cartItem){
                    $order->orderItems()->create([
                        'product_id' => $cartItem->product_id,
                        'price' => $cartItem->product->price *$this->rate
                    ]);
                    $cartItem->product->update(['quantity' => $cartItem->product->quantity - $cartItem->quantity]);
                }
                $this->update(['checkouted' => true]);
                $order->orderItems;
                DB::commit();
                return $order;

            }catch(\Throwable $th){
                DB::rollBack();
                return 'error!';
            }
//          }return $result


    }
}

