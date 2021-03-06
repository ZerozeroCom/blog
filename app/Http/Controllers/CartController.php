<?php

namespace App\Http\Controllers;

use App\Http\Services\CartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Cart;


class CartController extends Controller
{
    protected $cartService;
    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
/*        $cart =DB::table('carts')->get()->first();
        if(empty($carts)){
            DB::table('carts')->insert(['created_at'=> now(), 'updated_at'=>now()]);
            $cart =DB::table('carts')->get()->first();
        }
        $cartItems = DB::table('cart_items')->where('cart_id',$cart->id)->get();
        $cart = collect($cart);
        $cart['item'] = collect($cartItems);

        return response($cart);*/

        // with 自動撈出相關 節省效能  firstOrCreate 若沒有自動新增
        //$cart =Cart::with(['cartItems'])->firstOrCreate();
        $user =auth()->user();
        $cart =Cart::with(['cartItems'])->where('user_id', $user->id)
                                        ->where('checkouted',false)
                                        ->firstOrCreate(['user_id' => $user->id]);
        return response($cart);
    }
    public function checkout(){
        $user = auth()->user();
        //with()  順便把底下的資料撈出 節省效能
        $cart = $user->carts()->where('checkouted',false)->with('cartItems')->first();
        if($cart){
            $result =$this->cartService->checkout($cart);
            return response($result);
        }else{
            return response('沒有購物車',400);
        }


    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
