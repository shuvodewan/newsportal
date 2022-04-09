<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\Forgot;
use App\Models\Admin;
use App\Models\GeneralSettings;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Classes\GeniusMailer;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:admin');
    }
    
    public function loginForm(){
        return view('admin.login');
    }

    public function login(Request $request){
            $rules = [
                'email'    => 'required|email',
                'password' => 'required'
            ];

            $validator = Validator::make($request->all(),$rules);

            if($validator->fails()){
                return response()->json(['errors'=>$validator->getMessageBag()->toArray()]);
            }

        if(Auth::guard('admin')->attempt(['email'=>$request->email,'password'=>$request->password], $request->remember)){
            if(Auth::guard('admin')->user()->verify == 0)
            {
                Auth::guard('admin')->logout();
                return response()->json(array('errors' => [ 0 => 'Your Email is not Verified!' ]));   
            }

            if(Auth::guard('admin')->user()->role_id == 1){
                return response()->json(route('admin.dashboard'));
            }else{
                Auth::guard('admin')->logout();
                return response()->json(array('errors' => [ 0 => 'Credentials Doesn\'t Match !' ]));
            }

        }else{
            return response()->json(array('errors' => [0 => 'Credentail Doesn,t Match']));
        }
    }

    public function showForgotForm()
    {
      return view('admin.forgot');
    }

    public function forgot(Request $request)
    {
      $gs = GeneralSettings::findOrFail(1);
      $input =  $request->all();

      if (Admin::where('email', '=', $request->email)->count() > 0) {
        // user found
        $admin = Admin::where('email', '=', $request->email)->firstOrFail();
        $autopass = Str::random(8);
        $input['password'] = bcrypt($autopass);
        $admin->update($input);
        $subject = "Reset Password Request";
        $msg = "Your New Password is : ".$autopass;
        if($gs->is_smtp == 1)
        {
            $data = [
                    'to' => $request->email,
                    'subject' => $subject,
                    'body' => $msg,
            ];
  
            $mailer = new GeniusMailer();
            $mailer->sendCustomMail($data);                
        }
        else
        {
            $headers = "From: ".$gs->from_name."<".$gs->from_email.">";
            mail($request->email,$subject,$msg,$headers);            
        }
        return response()->json('Your Password Reseted Successfully. Please Check your email for new Password.');
        }
        else{
        // user not found
        return response()->json(array('errors' => [ 0 => 'No Account Found With This Email.' ]));    
        }  
    }
}
