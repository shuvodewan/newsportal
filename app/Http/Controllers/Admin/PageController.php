<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Models\Page;
use Datatables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Brian2694\Toastr\Facades\Toastr;

class PageController extends Controller
{
    public function datatables(){
        $datas = Page::orderBy('id','desc')->get();
        return Datatables::of($datas)
                            ->addColumn('action', function(Page $data) {
                                return '<div class="action-list"><a data-href="'.route('admin.page.edit',$data->id) .'" class="edit" data-toggle="modal" data-target="#modal1"> <i class="fas fa-edit"></i>Edit</a><a href="javascript:;" data-href="'.route('admin.page.delete',$data->id).'" data-toggle="modal" data-target="#confirm-delete" class="delete"><i class="fas fa-trash-alt"></i></a></div>';
                            })
                            ->editColumn('language_id',function(Page $data){
                                return $language = $data->language_id ? $data->language->language : '';
                            })
                            ->editColumn('status',function(Page $data){
                                return $status = $data->status == 1 ? '<span class="btn btn-sm btn-success">Active</span>':'<span class="btn btn-sm btn-danger">Inactive</span>';
                            })
                            ->rawColumns(['action','language_id','status'])
                            ->toJson();
    }
    public function index(){
        return view('admin.page.index');
    }
    public function create(){
        $languages = Language::orderBy('id','desc')->get();
        return view('admin.page.create',compact('languages'));
    }
    //slug create 
    public function slugCreate(Request $request){
        $data = 1;
        $val =  $request->title;
        $output = slug_create($val); //slug_create() from helper.php
        return $output;
    }

    public function store(Request $request){
        $rules = [
            'language_id' => 'required',
            'title' => 'required',
            'slug' => 'required|unique:pages',
            'description' => 'required',
        ];
        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }

        $data = new Page();
        $input = $request->all();
        $data->fill($input)->save();
        $msg = 'Data Added Successfully';
        return response()->json($msg);
    }
    public function edit($id){
        $data = Page::find($id);
        $languages = Language::orderBy('id','desc')->get();
        return view('admin.page.edit',compact('data','languages'));
    }
    public function update(Request $request,$id){
        $rules = [
            'language_id' => 'required',
            'title' => 'required',
            'slug' => 'required|unique:pages,slug,'.$id,
            'description' => 'required',
        ];
        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        
        $data = Page::find($id);
        $input = $request->all();
        $data->update($input);
        $msg = 'Data Updated Successfully';
        return response()->json($msg);
    }
    public function delete($id){
        $data = Page::find($id)->delete();
        $msg = 'Data Deleted Successfully';
        return response()->json($msg);
    }
}
