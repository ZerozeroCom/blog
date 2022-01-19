<?php

use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', 'WebController@index');
Route::get('/contact-us', 'WebController@contactUs');
Route::post('/read-notification', 'WebController@readNotification');
Route::post('/products/check-product', 'ProductController@checkProduct');
Route::get('/products/{id}/shared-url', 'ProductController@getShortUrl');
Route::resource('products','ProductController');


Route::post('/','ProductController@index');
Route::post('signup','AuthController@signup');
Route::post('login','AuthController@login');

Route::resource('admin/orders','Admin\OrderController');
Route::resource('admin/products','Admin\ProductController');
Route::post('/admin/products/upload-image','Admin\ProductController@uploadImage');

Route::post('/admin/products/excel/import','Admin\ProductController@import');
Route::get('/admin/orders/excel/export','Admin\OrderController@export');
Route::post('admin/orders/{id}/delivery','Admin\OrderController@delivery');
Route::post('admin/tools/update-product-price','Admin\ToolController@updateProductPrice');
Route::post('admin/tools/create-product-redis','Admin\ToolController@createProductRedis');

Route::group(['middleware' => 'check.dirty','auth:api'],function(){
    Route::get('user','AuthController@user');
    Route::get('logout','AuthController@');
    Route::post('carts/checkout','CartController@checkout');
    Route::resource('carts','CartController');
    Route::resource('cart-items','CartItemController');
});


/*Route::get('/', function () {
    return view('index');
});*/

//範例 php artisan route:list   ; php artisan make:controller ProductController --resource   ; composer dump-autoload //重新讀取
/*
Route::group([
    'middleware' =>  ['checkValidIp'],
    'prefix' => 'web',
    'namespace' => 'web'
], function(){
    Route::get('/index','HomeController@index');
    Route::post('/print','HomeController@print');
});
*/
