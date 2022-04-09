<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Models\Widget;
use App\Models\WidgetSetiings;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Datatables;

class WidgetController extends Controller
{
    public function datatables(){
        $datas = Widget::orderBy('id','desc')->get();
        return Datatables::of($datas)
                            ->addColumn('action', function(Widget $data) {
                                return '<div class="action-list"><a data-href="'.route('widget.edit',$data->id) .'" class="edit" data-toggle="modal" data-target="#modal1"> <i class="fas fa-edit"></i>Edit</a><a href="javascript:;" data-href="'.route('widget.delete',$data->id).'" data-toggle="modal" data-target="#confirm-delete" class="delete"><i class="fas fa-trash-alt"></i></a></div>';
                            })
                            ->editColumn('language_id',function(Widget $data){
                                return $language = $data->language_id ? $data->language->language : '';
                            })
                            ->editColumn('status',function(Widget $data){
                                $status = $data->status == 1 ? '<span class="btn btn-success btn-sm" style="border-radius: 15px;"> <i class="fas fa-eye"></i> visible</span>' : '<span class="btn btn-danger btn-sm" style="border-radius: 15px;"> <i class="fas fa-eye-slash"></i> Invisisble</span>';
                                return $status;
                            })
                            ->rawColumns(['action','language_id','status'])
                            ->toJson();
    }
    public function index(){
        return view('admin.widget.index');
    }
    public function create(){
        $languages = Language::orderBy('id','desc')->get();
        return view('admin.widget.create',compact('languages'));
    }

    public function store(Request $request){
        $rules = [
            'language_id' => 'required',
            'description' => 'required',
            'title' => 'required',
        ];
        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            return response()->json(array('errors'=>$validator->getMessageBag()->toArray()));
        }
        $data  = new Widget();
        $input = $request->all();
        $data->fill($input)->save();
        $msg = 'Data Added Successfully';
        return response()->json($msg);
    }

    public function edit($id){
        $data = widget::find($id);
        $languages = Language::orderBy('id','desc')->get();
        return view('admin.widget.edit',compact('data','languages'));
    }

    public function update(Request $request,$id){
        $rules = [
            'language_id' => 'required',
            'description' => 'required',
            'title' => 'required',
        ];
        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            return response()->json(array('errors'=>$validator->getMessageBag()->toArray()));
        }
        $data = widget::find($id);
        $input = $request->all();
        $data->update($input);
        $msg = 'Data Updated Successfully';
        return response()->json($msg);
    }

    public function widgetSettings(){
        $data = WidgetSetiings::find(1);
        return view('admin.widget.widgetsettings',compact('data'));
    }

    public function widgetSettingsUpdate(Request $request){
        $data = WidgetSetiings::find(1);
        $input = $request->all();

        if($request->feature_inhome){
            $input['feature_inhome'] = 1;
        }else{
            $input['feature_inhome'] = 0;
        }

        if($request->category_inhome){
            $input['category_inhome'] = 1;
        }else{
            $input['category_inhome'] = 0;
        }

        if($request->follow_inhome){
            $input['follow_inhome'] = 1;
        }else{
            $input['follow_inhome'] = 0;
        }

        if($request->tag_inhome){
            $input['tag_inhome'] = 1;
        }else{
            $input['tag_inhome'] = 0;
        }

        if($request->poll_inhome){
            $input['poll_inhome'] = 1;
        }else{
            $input['poll_inhome'] = 0;
        }

        if($request->calendar_inhome){
            $input['calendar_inhome'] = 1;
        }else{
            $input['calendar_inhome'] = 0;
        }

        if($request->newsletter_inhome){
            $input['newsletter_inhome'] = 1;
        }else{
            $input['newsletter_inhome'] = 0;
        }

        if($request->category_incategory){
            $input['category_incategory'] = 1;
        }else{
            $input['category_incategory'] = 0;
        }

        if($request->newsletter_incategory){
            $input['newsletter_incategory'] = 1;
        }else{
            $input['newsletter_incategory'] = 0;
        }

        if($request->calendar_incategory){
            $input['calendar_incategory'] = 1;
        }else{
            $input['calendar_incategory'] = 0;
        }

        if($request->category_indetails){
            $input['category_indetails'] = 1;
        }else{
            $input['category_indetails'] = 0;
        }

        if($request->newsletter_indetails){
            $input['newsletter_indetails'] = 1;
        }else{
            $input['newsletter_indetails'] = 0;
        }

        if($request->calendar_indetails){
            $input['calendar_indetails'] = 1;
        }else{
            $input['calendar_indetails'] = 0;
        }


        $data->update($input);
        $msg = 'Data Updated Successfully';
        return response()->json($msg);
    }
    
    public function delete($id){
        $data = widget::find($id)->delete();
        $msg = 'Data Deleted Successfully';
        return response()->json($msg);
    }
}
