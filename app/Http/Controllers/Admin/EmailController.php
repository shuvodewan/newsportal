<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\GeneralSettings;

class EmailController extends Controller
{
    public function config(){
        $data = GeneralSettings::find(1);
        return view('admin.email.config',compact('data'));
    }
    public function group(){
        return view('admin.email.group');
    }
}
