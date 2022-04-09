<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SocialSettings;

class SocialSettingsController extends Controller
{
    public function update(Request $request){
        $data = SocialSettings::find(1);
        $input = $request->all();
        $data->update($input);
        $msg = 'Data Updated Successfully';
        return response()->json($msg);
    }
    public function google(){
        $data = SocialSettings::find(1);
        return view('admin.socialsettings.google',compact('data'));
    }
    public function facebook(){
        $data = SocialSettings::find(1);
        return view('admin.socialsettings.facebook',compact('data'));
    }
}
