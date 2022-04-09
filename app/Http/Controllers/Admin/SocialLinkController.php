<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Datatables;
use App\Models\SocialLink;

class SocialLinkController extends Controller
{
    public function datatables(){
        $datas = SocialLink::orderBy('id','desc')->get();
        return Datatables::of($datas)
                            ->addColumn('action', function(SocialLink $data) {
                                return '<div class="action-list"><a data-href="'.route('social.link.edit',$data->id) .'" class="edit" data-toggle="modal" data-target="#modal1"> <i class="fas fa-edit"></i>Edit</a><a href="javascript:;" data-href="'.route('social.link.delete',$data->id).'" data-toggle="modal" data-target="#confirm-delete" class="delete"><i class="fas fa-trash-alt"></i></a></div>';
                            })
                            ->editColumn('icon',function(SocialLink $data){
                                return $icon = $data->icon ? '<i class="'.$data->icon.'"></i>':'';
                            })
                            ->rawColumns(['action','icon'])
                            ->toJson();
    }
    public function index(){
        return view('admin.sociallink.index');
    }
    public function create(){
        return view('admin.sociallink.create');
    }
    public function store(Request $request){
        $data  = new SocialLink();
        $input = $request->all();
        $data->fill($input)->save();
        $msg = 'Data Added Successfully';
        return response()->json($msg);
    }
    public function edit($id){
        $data = SocialLink::find($id);
        return view('admin.sociallink.edit',compact('data'));
    }
    public function update(Request $request,$id){
        $data = SocialLink::find($id);
        $input = $request->all();
        $data->fill($input)->save();
        $msg = 'Data Updated Successfully';
        return response()->json($msg);
    }
    public function delete($id){
        $data = SocialLink::find($id)->delete();
        $msg = 'Data Deleted Successfully';
        return response()->json($msg);
    }
}
