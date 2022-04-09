<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Seo;

class SeoController extends Controller
{
    public function update(Request $request){
        $data  = Seo::find(1);
        $input = $request->all();
        $data->update($input);
        $msg = 'Data Updated Successfully';
        return response()->json($msg);
    }
    public function googleAnalytics(){
        $data  = Seo::find(1);
        return view('admin.seo.googleAnalytics',compact('data'));
    }
    public function metaKeywords(){
        $data  = Seo::find(1);
        return view('admin.seo.metaKeywords',compact('data'));
    }
}
