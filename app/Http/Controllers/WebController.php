<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;

//抓出Notification程式  預設MODEL
use Illuminate\Notifications\DatabaseNotification;

class WebController extends Controller
{
    public $notifications = [];
    public function __construct()
    {
        $user = User::find(3);
        // ?? 若前面不存在就設定為後方值
        $this->notifications = $user->notifications ?? [];
    }
    public function index(){
        $products = Product::all();

        return view('index',['products' => $products],['notifications' =>$this->notifications]);
    }
    public function contactUs(){
        return view('contact_us',['notifications' =>$this->notifications]);
    }
    public function readNotification(Request $request){
        $id = $request->all()['id'];
        //預設的押上已讀函式
        DatabaseNotification::find($id)->markAsRead();
        return response(['result'=>true]);
    }
}

