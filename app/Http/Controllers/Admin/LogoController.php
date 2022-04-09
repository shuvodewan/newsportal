<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Models\Logo;
use Datatables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LogoController extends Controller
{
    public function datatables(){
        $datas = Logo::orderBy('id','desc')
                            ->get();

        //--- Integrating This Collection Into Datatables
        return Datatables::of($datas)
                            ->addColumn('action', function(Logo $data) {
                                return '<div class="action-list"><a href="'.route('admin.languagelogo.edit',$data->id) .'" class="edit"> <i class="fas fa-edit"></i>Edit</a><a href="javascript:;" data-href="'.route('admin.languagelogo.delete',$data->id).'" data-toggle="modal" data-target="#confirm-delete" class="delete"><i class="fas fa-trash-alt"></i></a></div>';
                            })
                            ->editColumn('header_logo',function(Logo $data){
                                $header_logo = $data->header_logo ? url('assets/images/logo/'.$data->header_logo):url('assets/images/nopic.png');
                                return '<img src="'.$header_logo.'" alt="Image">';
                            })
                            ->editColumn('footer_logo',function(Logo $data){
                                $footer_logo = $data->footer_logo ? url('assets/images/logo/'.$data->footer_logo):url('assets/images/nopic.png');
                                return '<img src="'.$footer_logo.'" alt="Image">';
                            })
                            ->editColumn('language_id',function(Logo $data){
                                return $language_id = $data->language_id ? $data->language->language : '';
                            })
                            
                            ->rawColumns(['action','header_logo','footer_logo','language_id'])
                            ->toJson(); //--- Returning Json Data To Client Side
    }

    public function index(){
        return view('admin.logo.index');
    }

    public function create(){
        $data['languages'] = Language::orderBy('id','desc')->get();
        return view('admin.logo.create',$data);
    }

    public function store(Request $request){
        $rules = [
            'language_id' => 'required|unique:logos',
            'header_logo'  => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'footer_logo'  => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ];

        $validator = Validator::make($request->all(),$rules);
        
        if($validator->fails()){
            return response()->json(array('errors'=>$validator->getMessageBag()->toArray()));
        }

        $input =$request->all();
        $data = new Logo();
        
        if($request->hasFile('header_logo')){
            $header_logo = $request->file('header_logo');
            $header_name = time().$header_logo->getClientOriginalName();
            $header_logo->move('assets/images/logo/',$header_name);
            $input['header_logo'] = $header_name;
        }

        if($request->hasFile('footer_logo')){
            $footer_logo = $request->file('footer_logo');
            $footer_name = time().$footer_logo->getClientOriginalName();
            $footer_logo->move('assets/images/logo/',$footer_name);
            $input['footer_logo'] = $footer_name;
        }

        $data->fill($input)->save();
        $msg = 'Data added successfully';
        return response()->json($msg);

    }

    public function edit($id){
        $data['data'] = Logo::findOrFail($id);
        $data['languages'] = Language::orderBy('id','desc')->get();
        return view('admin.logo.edit',$data);
    }

    public function update(Request $request,$id){
        $data = Logo::findOrFail($id);

        $rules = [
            'language_id' => 'required|unique:logos,language_id,'.$id,
            'header_logo'  => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'footer_logo'  => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ];

        $validator = Validator::make($request->all(),$rules);
        
        if($validator->fails()){
            return response()->json(array('errors'=>$validator->getMessageBag()->toArray()));
        }

        $input =$request->all();
        
        if($request->hasFile('header_logo')){
            $header_logo = $request->file('header_logo');
            $name = time().$header_logo->getClientOriginalName();
            $header_logo->move('assets/images/logo/',$name);
            @unlink('assets/images/logo/'.$data->header_logo);
            $input['header_logo'] = $name;
        }

        if($request->hasFile('footer_logo')){
            $footer_logo = $request->file('footer_logo');
            $name = time().$footer_logo->getClientOriginalName();
            $footer_logo->move('assets/images/logo/',$name);
            @unlink('assets/images/logo/'.$data->footer_logo);
            $input['footer_logo'] = $name;
        }

        $data->update($input);
        $msg = 'Data updated successfully';
        return response()->json($msg);
    }

    public function delete($id){
        $data = Logo::findOrFail($id);

        @unlink('assets/images/logo/'.$data->header_logo);
        @unlink('assets/images/logo/'.$data->footer_logo);

        $data->delete();
        $msg = 'Data updated successfully';
        return response()->json($msg);
    }
}
