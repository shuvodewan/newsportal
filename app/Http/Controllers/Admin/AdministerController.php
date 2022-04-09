<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Role;
use Datatables;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class AdministerController extends Controller
{
    public function datatables(){
        $datas = Admin::where('id','=',1);
        return Datatables::of($datas)
                            ->addColumn('action', function(Admin $data) {
                                $delete = $data->id == 1 ? '':'<a href="javascript:;" data-href="'.route('admin.staff.delete',$data->id).'" data-toggle="modal" data-target="#confirm-delete" class="delete"><i class="fas fa-trash-alt"></i></a>';
                                return '<div class="action-list"><a data-href="'.route('admin.staff.edit',$data->id) .'" class="edit" data-toggle="modal" data-target="#modal1"> <i class="fas fa-edit"></i>Edit</a>'.$delete.'</div>';
                            })
                            ->editColumn('role_id',function(Admin $data){
                                return $role = $data->role_id ? $data->role->name:'';
                            })
                            ->rawColumns(['action','role_id'])
                            ->toJson();
    }
    public function index(){
        return view('admin.administrator.index');
    }

    public function edit($id){
        $data = Admin::find($id);
        $roles = Role::orderBy('id','desc')->get();
        return view('admin.staff.edit',compact('data','roles'));
    }
    public function update(Request $request,$id){
        $rules = [
            'name' => 'required',
            'email' => 'required|unique:admins,email,'.$id,
            'phone' => 'required',
            'role_id' => 'required',
            'photo' => 'image|mimes:jpeg,png,jpg,gif,svg',
        ];
        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            return response()->json(['errors'=>$validator->getMessageBag()->toArray()]);
        }
        $data  = Admin::find($id);
        $input = $request->all();
        if($request->hasFile('photo')){
            $file = $request->file('photo');
            $name = time().$file->getClientOriginalName();
            $file->move('assets/images/admin/',$name);
            @unlink('assets/images/admin/'.$data->photo);
            $input['photo'] = $name; 
        }
        $data->update($input);
        $msg = 'Data Updated Sucessfully';
        return response()->json($msg);
    }
    public function delete($id){
        $data  = Admin::find($id);
        @unlink('assets/images/admin/'.$data->photo);
        $data->delete();
    }
}
