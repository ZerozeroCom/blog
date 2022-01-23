<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateUser;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    //

    public function signup(CreateUser $request)
    {
        //$form = $request->all();
        $validatedData = $request->validated();
        $user = new User([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),

        ]);
        $user->save();
        return response('success',201);
    }

    public function login(Request $request){
            $validatedData = $request->validate([
                    'email' => 'required|string|email',
                    'password' => 'required|string'
                ]);
 //               dd($request->user());
                if(!Auth::attempt($validatedData)){
                    return response('授權失敗2',401);
                }
                $user =$request->user();
    //            dd($request->email);
                $tokenResult =$user->createToken('Token');
    //            dd($tokenResult->attributes['token']);
  //              $tokenResult ->token->save();
                return response(['token'=>$tokenResult->accessToken]);
    }
    public function user(Request $request)
    {
        return response(
            $request->user()
        );
    }

    public function logout(Request $request){
    //    dd($request->user()->remember_token);
        $user = $request->user()->id;
        //dd($user);
        DB::table('personal_access_tokens')->where('tokenable_id',$user)->delete();
        Auth::logout();
        return response(
            ['message' => '成功登出']
        );
    }

}
