<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Role;
use Datatables;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    public function datatables(){
        $datas = Role::orderBy('id','desc')->get();
        return Datatables::of($datas)
                                ->addColumn('action', function(Role $data) {
                                    return '<div class="action-list"><a href="'.route('admin.role.edit',$data->id).'"> <i class="fas fa-edit"></i>Edit</a><a href="javascript:;" data-href="'.route('admin.role.delete',$data->id).'" data-toggle="modal" data-target="#confirm-delete" class="delete"><i class="fas fa-trash-alt"></i></a></div>';
                                }) 
                                ->editColumn('section',function(Role $data){
                                    $value = $data->section ? json_decode($data->section) : '';
                                    $sections = str_replace('_',' ',$value);
                                    return $sections;
                                })
                                ->rawColumns(['action','section'])
                                ->toJson();
    }
    public function index(){
        // return $datas = Role::orderBy('id','desc')->get();
        return view('admin.role.index');
    }
    public function create(){
        return view('admin.role.create');
    }
    public function store(Request $request){
        $rules = [
            'name'  => 'required',
            'section' => 'required',
        ];
        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            return response()->json(['errors'=>$validator->getMessageBag()->toArray()]);
        }
        $data  = new Role();
        $input = $request->all();
        $input['section'] = json_encode($request->section);
        $data->fill($input)->save();
        $msg = 'Data Added Successfully';
        return response()->json($msg);
    }
    public function edit($id){
        $data = Role::find($id);
        $values = json_decode($data->section);
        return view('admin.role.edit',compact('data','values'));
    }
    public function update(Request $request,$id){
        $rules = [
            'name'  => 'required',
            'section' => 'required',
        ];
        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            return response()->json(['errors'=>$validator->getMessageBag()->toArray()]);
        }
        $data  = Role::find($id);
        $input = $request->all();
        $input['section'] = json_encode($request->section);
        $data->update($input);
        $msg = 'Data Updated Successfully';
        return response()->json($msg);
    }
    public function delete($id){
        $data  = Role::find($id)->delete();
        $msg = 'Data Deleted Successfully';
        return response()->json($msg);
    }
}
