<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Jobs\UpdateProductPrice;
use Illuminate\Support\Facades\Redis;
//php artisan make:job UpdateProductPrice
//php artisan queue:table
//php artisan migrete
//php artisan queue:work database --queue=default
//php artisan queue:work database --queue=tool


class ToolController extends Controller
{
    public function updateProductPrice(){
        $products = Product::all();
        foreach($products as $product){
            //跑job
            UpdateProductPrice::dispatch($product)->onQueue('tool');
        }
    }
    public function createProductRedis(){

        Redis::set('products',json_encode(Product::all()));
    }
}
