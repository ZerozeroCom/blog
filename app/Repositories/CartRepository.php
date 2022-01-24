<?php
namespace App\Repositories;

use App\Models\Cart;

class CartRepository extends Repository{

    public function scopeBelongUser($user){
        $this->with(['cartItems'])->where('user_id', $user->id)
                                        ->where('checkouted',false);
        return $this;
    }

    public function model(){
        return Cart::class;
    }
    public function scopeReport(){
        return $this->model->where('checkouted',true)
                           ->whereHas('users',function($query){
                               $query->where('level',1)
                                     ->where('created_at','>','2020-11-01');
                           });
    }
}
