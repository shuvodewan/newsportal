<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Language;
use Toastr;

class MenuBuilderController extends Controller
{
    public function index(){
        $default_language   = Language::where('is_default',1)->first();
        $first_category = Category::where('parent_id','=',null)->where('language_id','=',$default_language->id)->first();
        $data['menuBuilders'] = Category::orderBy('category_order','asc')
                                        ->where('id', '!=' , $first_category->id)
                                        ->where('parent_id','=',null)
                                        ->where('language_id','=',$default_language->id)
                                        ->where('id','!=',$first_category->id)
                                        ->get();
        return view('admin.menu-builder.index',$data);
    }

    public function store(Request $request){
        $category_list = $request->category_id_array;
        for($i=0; $i<count($category_list); $i++)
        {
            $category_id = $category_list[$i];
            $data = Category::find($category_id);
            $data->category_order = $i;
            $data->update();
        }
        $msg = 'Menu Updated Successfully';
        return response()->json($msg);
    }
}
