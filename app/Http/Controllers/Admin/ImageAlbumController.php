<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ImageAlbum;
use App\Models\Language;
use Datatables;
use Illuminate\Support\Facades\Validator;

class ImageAlbumController extends Controller
{
    public function datatables(){
       $datas = ImageAlbum::orderBy('id','desc')->get();
       return Datatables::of($datas)
                            ->addColumn('action', function(ImageAlbum $data) {
                                return '<div class="action-list"><a data-href="'.route('image.album.edit',$data->id) .'" class="edit" data-toggle="modal" data-target="#modal1"> <i class="fas fa-edit"></i>Edit</a><a href="javascript:;" data-href="'.route('image.album.delete',$data->id).'" data-toggle="modal" data-target="#confirm-delete" class="delete"><i class="fas fa-trash-alt"></i></a></div>';
                            })
                            ->editColumn('photo',function(ImageAlbum $data){
                                $photo = $data->photo ? url('assets/images/image-album/'.$data->photo) : url('assets/images/noimage.png');
                                return '<img src="'.$photo.'" alt="">';
                            })
                            ->editColumn('language_id',function(ImageAlbum $data){
                                return $language = $data->language_id ? $data->language->language : '';
                            })
                            ->rawColumns(['action','photo','language_id'])
                            ->toJson();
    }
    public function index(){
        return view('admin.image-album.index');
    }
    public function create(){
        $datas = Language::orderBy('id','desc')->get();
        return view('admin.image-album.create',compact('datas'));
    }
    public function store(Request $request){
        $rules = [
            'language_id' => 'required',
            'photo'        => 'mimes:jpeg,jpg,png,svg',
            'album_name' => 'required|unique:image_albums'
        ];

        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            return response()->json(array('errors'=>$validator->getMessageBag()->toArray()));
        }

        $data  = new ImageAlbum();
        $input = $request->all();
        if($request->hasFile('photo')){
            $file = $request->file('photo');
            $name = time().$file->getClientOriginalName();
            $file->move('assets/images/image-album/',$name);
            $input['photo'] = $name;
        }
        $data->fill($input)->save();
        $msg = 'Data Added Successfully';
        return response()->json($msg);
    }
    public function edit($id){
        $data = ImageAlbum::find($id);
        $languages = Language::orderBy('id','desc')->get();
        return view('admin.image-album.edit',compact('data','languages'));
    }
    public function update(Request $request,$id){
        $rules = [
            'language_id' => 'required',
            'photo'        => 'mimes:jpeg,jpg,png,svg',
            'album_name' => 'required|unique:image_albums,album_name,'.$id
        ];

        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            return response()->json(array('errors'=>$validator->getMessageBag()->toArray()));
        }
        $data = ImageAlbum::find($id);
        $input = $request->all();
        if($request->hasFile('photo')){
            $file = $request->file('photo');
            $name = time().$file->getClientOriginalName();
            $file->move('assets/images/image-album/',$name);
            @unlink('assets/images/image-album/'.$data->photo);
            $input['photo'] = $name;
        }
        $data->update($input);
        $msg = 'Data Updated Successfully';
        return response()->json($msg);
    }
    public function delete($id){
        $data = ImageAlbum::find($id);
        @unlink('assets/images/image-album/'.$data->photo);
        $data->delete();
        $msg = 'Data Deleted Successfully';
        return response()->json($msg);
    }
}
