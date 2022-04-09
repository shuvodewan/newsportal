<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\RegisterMail;
use App\Models\Admin;
use App\Models\GeneralSettings;
use App\Models\Role;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Validator;
use Toastr;
use Auth;
use App\Classes\GeniusMailer;

class RegisterController extends Controller
{
    public function LogReg(){
        $this->code_image();
        return view('frontend.log-reg');
    }

    public function register(Request $request){
         $role = Role::where('name','user')->first();
        $gs = GeneralSettings::findOrFail(1);

    	if($gs->is_capcha == 1)
    	{
            $value = session('captcha_string');
	        if ($request->codes != $value){
	            return response()->json(array('errors' => [ 0 => 'Please enter Correct Capcha Code.' ]));    
	        }    		
        }

        //--- Validation Section
        $rules = [
            'email'   => 'required|email|unique:admins',
            'password' => 'required|confirmed'
            ];
        $validator = Validator::make($request->all(), $rules);
        
        if ($validator->fails()) {
            return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        //--- Validation Section Ends

        $gs = GeneralSettings::findOrFail(1);
        $author  = new Admin();
        $input = $request->all();
        $input['role_id'] = $role->id;
        $input['password'] =bcrypt($request['password']);
        $input['token'] = md5(time().$request->name.$request->email);
        $token  = $input['token'];

        $author->fill($input)->save();
        
        if($gs->is_verification_email == 1)
        {
        $to = $request->email;
        $subject = 'Verify your email address.';
        $msg = "Dear Customer,<br> We noticed that you need to verify your email address. <a href=".url('register/verify/'.$token).">Simply click here to verify. </a>";
        //Sending Email To Customer
        if($gs->is_smtp == 1)
        {
        $data = [
            'to' => $to,
            'subject' => $subject,
            'body' => $msg,
        ];

        $mailer = new GeniusMailer();
        $mailer->sendCustomMail($data);
        }
        else
        {
        $headers = "From: ".$gs->from_name."<".$gs->from_email.">";
        mail($to,$subject,$msg,$headers);
        }
        return response()->json('We need to verify your email address. We have sent an email to '.$to.' to verify your email address.');
        }

    }

    public function token($token)
    {
          $author = Admin::where('token',$token)->first();
          if($author){
              $data = Admin::find($author->id);
              $data->status = 1;
              $data->verify = 1;
              $data->token  = NULL;
              $data->update();
              Auth::guard('admin')->login($author);
              Toastr::success('You are welcome!','success');
              return redirect()->route('frontend.index');
          }
          else{
              Toastr::error('Token mismatch!','error');
              return redirect('/');
          }
    }

    // Capcha Code Image
    private function  code_image()
    {
        $actual_path = str_replace('project','',base_path());
        $image = imagecreatetruecolor(200, 50);
        $background_color = imagecolorallocate($image, 255, 255, 255);
        imagefilledrectangle($image,0,0,200,50,$background_color);

        $pixel = imagecolorallocate($image, 0,0,255);
        for($i=0;$i<500;$i++)
        {
            imagesetpixel($image,rand()%200,rand()%50,$pixel);
        }

        $font = $actual_path.'assets/front/fonts/NotoSans-Bold.ttf';
        $allowed_letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        $length = strlen($allowed_letters);
        $letter = $allowed_letters[rand(0, $length-1)];
        $word='';
        //$text_color = imagecolorallocate($image, 8, 186, 239);
        $text_color = imagecolorallocate($image, 0, 0, 0);
        $cap_length=6;// No. of character in image
        for ($i = 0; $i< $cap_length;$i++)
        {
            $letter = $allowed_letters[rand(0, $length-1)];
            imagettftext($image, 25, 1, 35+($i*25), 35, $text_color, $font, $letter);
            $word.=$letter;
        }
        $pixels = imagecolorallocate($image, 8, 186, 239);
        for($i=0;$i<500;$i++)
        {
            imagesetpixel($image,rand()%200,rand()%50,$pixels);
        }
        session(['captcha_string' => $word]);
        imagepng($image, $actual_path."assets/images/capcha_code.png");
    }
}
