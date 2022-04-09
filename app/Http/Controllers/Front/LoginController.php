<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
       if(Auth::guard('admin')->attempt(['email'=>$request->email,'password'=>$request->password], $request->remember))
       {
            if(Auth::guard('admin')->user()->verify == 0)
            {
                Auth::guard('admin')->logout();
                return response()->json(array('errors' => [ 0 => 'Your Email is not Verified!' ]));   
            }

            if(Auth::guard('admin')->user()->role_id != 1){
                return response()->json(route('frontend.index'));
            }else{
                Auth::guard('admin')->logout();
                return response()->json(array('errors' => [ 0 => 'Credentials Doesn\'t Match !' ]));
            }
       }
          return response()->json(array('errors' => [ 0 => 'Credentials Doesn\'t Match !' ]));
    }

    public function logout(){
        Auth::guard('admin')->logout();
        return redirect('/');
    }
}
