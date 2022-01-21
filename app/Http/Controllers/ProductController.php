<?php

//外部引用必須的
namespace App\Http\Controllers;


//匯入  可按著ctrl點擊追蹤


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use Illuminate\Support\Facades\Redis;
use App\Http\Services\ShortUrlService;
use App\Http\Services\AuthService;

class ProductController extends Controller
{
    public function __construct(ShortUrlService $shortUrlService,AuthService $authService)
    {
        $this->shortUrlService = $shortUrlService;
        $this->authService = $authService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     *
     * dump($request);
     * dump($request -> all());  使用者傳遞的所有資料
     * dump($request -> path()); 網址
     * dump($request -> input('age',10)); 若未找到 代入10
     * dump($request -> query()); 純粹網址列參數
     * return response()->view('welcome'); 動態展現
     * return response('123',500); 回傳碼 HTTP碼須查詢 EX 404
     * return redirect('/'); 導頁
     */
    public function index(Request $request)
    {
        //dump($request -> path());
        //dump($request -> input('name'));
        //dump($request -> input('age',10));
       // dump($request);
       //     $data =$this ->getData();
       //$data = DB::table('products')->get(); 原始

//       $data = DB::table('city')->select('Name');
//       $data = $data->addSelect('District')->get();
//    $data = DB::table('city')->whereRaw('Population > 1000000')->get();
//        $data = DB::table('city')->join('country','city.CountryCode','=','country.Code')->select('*')->get();
//                                    leftJoin  rightJoin
/*閉包函式
    $data = DB::table('city')->join('country', function($join){
        $join->on('country.Code','=','city.CountryCode')
                 ->where('city.Population','>','2000000');
    })->select('*')->get();
*/
//        DB::enableQueryLog();
  //      $data = DB::table('countrylanguage')->insert(['CountryCode'=>'ABW','Language'=>'Dutch4','IsOfficial'=>'T','Percentage'=>5.5]);
 //       dd(DB::getQueryLog());
 //       DB::table('countrylanguage')->where('Language','Dutch4')->dump();
 //增加         DB::table('city')->where('ID',3)->increment('Population',2000000);
 //減少 無第二值只增減1         DB::table('city')->where('ID',3)->decrement('Population',2000000);

             $data = json_decode(Redis::get('products'));
            return response($data);


/*效能測試
            dump(now());
            for ($i=1;$i<=10000;$i++){
                $data = DB::table('products')->get();
            }
            dump(now());
            for ($i=1;$i<=10000;$i++){
                $data = json_decode(Redis::get('products'));
            }
            dump(now());
            return response($data);
*/

    }
    public function checkProduct(Request $request){
        $id = $request->all()['id'];
  //      dd($id); F12 Network可確認
        $product =Product::find($id);
        if($product->quantity >0){
            return response(true);
        }else{
            return response(false);
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
     * $newDataA =$request->all();
     *   $data = $this ->getData();
     *   array_push($data,$newDataA);
     *   return response($data);
     */
    // 檢查參數的資料類別
    public function store(Request $request)
    {
        $newDataA =$request->all();
        $data = $this ->getData();
        $data->push(collect($newDataA));
        return response($data);
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
     *
     * PUT  /{通常是id參數}
     * dd會暫時停止執行後面指令
     * 網址頁上的{ }傳入$id
     */
    public function update(Request $request, $id)
    {
        $newData = $request->all();
        $data =$this->getdata();
        $selectdata= $data->where('id',$id)->first();
        $selectdata= $selectdata->merge(collect($newData));
        return response($selectdata);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data =$this->getData();
        $data =$data->filter(function($product) use ($id){
            return $product['id'] != $id;
        });
        return response($data->values());
    }
//collect laravel 專用 比陣列有更多方便的功能可用
    public function getData(){
        return collect([
            collect([
                'id' => 0,
                'title' => '測試商品一',
                'content' => '這是很棒的商品',
                'price' => 50
            ]),
            collect([
                'id' => 1,
                'title' => '測試商品二',
                'content' => '這是有點棒的商品',
                'price' => 30
            ])


        ]);
    }

    public function getShortUrl($id){
        $this->authService->fakeReturn();
        $url = $this->shortUrlService->makeShortUrl("http://localhost:8000/products/$id");
        return response(['url'=>$url]);
    }

}
