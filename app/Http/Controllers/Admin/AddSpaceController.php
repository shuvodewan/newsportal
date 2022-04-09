<?php

namespace App\Http\Controllers\Admin;

use Datatables;
use Illuminate\Http\Request;
use App\Models\Advertisement;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class AddSpaceController extends Controller
{
    public function datatables(){
        $datas = Advertisement::orderBy('id','desc')->get();
        return Datatables::of($datas)
                            ->addColumn('action', function(Advertisement $data) {
                                return '<div class="action-list"><a data-href="'.route('ads.edit',$data->id) .'" class="edit" data-toggle="modal" data-target="#modal1"> <i class="fas fa-edit"></i>Edit</a><a href="javascript:;" data-href="'.route('ads.delete',$data->id).'" data-toggle="modal" data-target="#confirm-delete" class="delete"><i class="fas fa-trash-alt"></i></a></div>';
                            })
                            ->editColumn('photo',function(Advertisement $data){
                                if($data->banner_type == 'image'){
                                    $photo = $data->photo ? url('assets/images/addBanner/'.$data->photo):url('assets/images/noimage.png');
                                    return '<img src="'.$photo.'" alt="">';
                                }else{
                                   return $photo = $data->banner_code ? "AdSense Photo": '';
                                }
                            })
                            ->editColumn('add_placement',function(Advertisement $data){
                                $add_placement = $data->add_placement ? '<span class="badge badge-success">'.$data->add_placement.'</span>':'';
                                return $add_placement;
                            })
                            ->editColumn('addSize',function(Advertisement $data){
                                $addSize = $data->addSize ? '<span class="badge badge-primary">'.$data->addSize.'</span>':'';
                                return $addSize;
                            })
                            ->editColumn('status',function(Advertisement $data){
                                $status = $data->status==1 ? '<span class="badge badge-info">active</span>':'<span class="badge badge-danger">Inactive</span>';
                                return $status;
                            })
                            ->rawColumns(['action','photo','add_placement','addSize','status'])
                            ->toJson();
    }
    public function index(){
        return view('admin.ads.index');
    }
    public function create(){
        return view('admin.ads.create');
    }

    public function store(Request $request){

        $rules = [
            'photo'        => 'mimes:jpeg,jpg,png,svg',
            'add_placement' => 'required',
            'addSize' => 'required',
            'status' => 'required',
        ];

        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            return response()->json(array('errors'=>$validator->getMessageBag()->toArray()));
        }
        
        $data  = new Advertisement();
        $input = $request->all();
        if($file = $request->file('photo')){
            $name = time().$file->getClientOriginalName();
            $file->move('assets/images/addBanner/',$name);
            $input['photo'] = $name;
        }
        $data->fill($input)->save();
        $msg = 'Data Added Successfully';
        return response()->json($msg);
    }

    public function edit($id){
        $data = Advertisement::find($id);
        return view('admin.ads.edit',compact('data'));
    }

    public function update(Request $request,$id){
        $rules = [
            'photo'        => 'mimes:jpeg,jpg,png,svg',
            'add_placement' => 'required',
            'addSize' => 'required',
            'status' => 'required',
        ];

        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            return response()->json(array('errors'=>$validator->getMessageBag()->toArray()));
        }
        
        $data = Advertisement::find($id);
        $input = $request->all();
        if($request->hasFile('photo')){
            $file = $request->file('photo');
            $name = time().$file->getClientOriginalName();
            $file->move('assets/images/addBanner/',$name);
            @unlink('assets/images/addBanner/'.$data->photo);
            $input['photo'] = $name;
        }
        $data->update($input);
        $msg = 'Data Added Successfully';
        return response()->json($msg);
    }

    public function delete($id){
        $data = Advertisement::find($id)->delete();
        @unlink('assets/images/addBanner/'.$data->photo);
        $msg = 'Data Deleted Successfully';
        return response()->json($msg);
    }
}
