<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Subscriber;
use Illuminate\Support\Facades\Validator;
use Toastr;

class SubscriberController extends Controller
{
    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);
        if ($validator->fails()) {
            $id = 1;
            return response()->json($id);         
        }
        $subscriber =Subscriber::where('email',$request->email)->first();
        if(!empty($subscriber)){
            $id = 2;
            return response()->json($id); 
        }else{
            $data  = new Subscriber();
            $input = $request->all();
            $data->fill($input)->save();
            $id = 3;
            return response()->json($id);
        }
    }
}
