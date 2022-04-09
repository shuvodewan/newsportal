<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Font;
use Brian2694\Toastr\Facades\Toastr;
use Datatables;

class FontController extends Controller
{
    public function datatables(){
        $datas = Font::orderBy('id','desc')->get();
        return Datatables::of($datas)
                            ->addColumn('action',function(Font $data){
                                $default = $data->is_default == 1 ? '<a><i class="fa fa-check"></i> Default</a>' : '<a class="status" href="'.route('admin.fonts.status',$data->id).'">Set Default</a>';
                                return '<div class="action-list">'.$default.'</div>';
                            })
                            ->rawColumns(['action'])
                            ->toJson();
    }

    public function index(){
        return view('admin.fonts.index');
    }

    public function status($id){
        $font_update =  Font::find($id);
        $font_update->is_default = 1;
        $font_update->update();

        $previous_fonts = Font::where('id','!=',$id)->get();

        foreach($previous_fonts as $previous_font){
            $previous_font->is_default = 0;
            $previous_font->update();
        }
        Toastr::success('Data Updated Successfully');
        return redirect()->back();
   }
}
