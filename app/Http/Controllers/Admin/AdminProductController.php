<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;

class AdminProductController extends Controller
{
    public function index(Request $request){
        $productCount = Product::count();
        $dataPerPage =3;
        $productPages = ceil($productCount / $dataPerPage );
        $currentPage = isset($request->query()['page']) ? $request->query()['page'] : 1;
        $products = Product::orderBy('created_at', 'desc')
                        ->offset($dataPerPage *($currentPage -1))
                        ->limit($dataPerPage)
                        ->get();

        return view('admin.products.index',['products' => $products,
                                           'productCount' => $productCount,
                                            'productPages' =>$productPages]);
    }


}
