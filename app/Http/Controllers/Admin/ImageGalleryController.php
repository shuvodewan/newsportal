<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ImageAlbum;
use App\Models\ImageGallery;
use App\Models\Language;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Datatables;

class ImageGalleryController extends Controller
{
    public function datatables(){
        $datas = ImageGallery::orderBy('id','desc')->get();
        return Datatables::of($datas)
                            ->addColumn('action', function(ImageGallery $data) {
                                return '<div class="action-list"><a data-href="'.route('image.gallery.edit',$data->id) .'" class="edit" data-toggle="modal" data-target="#modal1"> <i class="fas fa-edit"></i>Edit</a><a href="javascript:;" data-href="'.route('image.gallery.delete',$data->id).'" data-toggle="modal" data-target="#confirm-delete" class="delete"><i class="fas fa-trash-alt"></i></a></div>';
                            })
                            ->editColumn('gallery',function(ImageGallery $data){
                                $gallery = $data->gallery ? url('assets/images/image-gallery/'.$data->gallery): url('assets/images/noimage.png');
                                return '<img src="'.$gallery.'" alt="Image">';
                            })
                            ->editColumn('image_album_id',function(ImageGallery $data){
                                return $album = $data->image_album_id ? $data->album->album_name : '';
                            })
                            ->editColumn('language_id',function(ImageGallery $data){
                                return $language = $data->language_id ? $data->language->language : '';
                            })
                            ->editColumn('image_category_id',function(ImageGallery $data){
                                return $category = $data->image_category_id ? $data->category->name : '';
                            })
                            ->rawColumns(['action','gallery','image_album_id','language_id','image_category_id'])
                            ->toJson();
    }
    public function index(){
        return view('admin.image-gallery.index');
    }
    public function create(){
        $languages = Language::orderBy('id','desc')->get();
        return view('admin.image-gallery.create',compact('languages'));
    }
    public function albumByLanguage($id){
        $datas = Language::find($id)->albums;
         $output = '<option value="">Please Select Your Album</option>';
         foreach($datas as $data){
             $output .= '<option value="'.$data->id.'">'.$data->album_name.'</option>';
         }
         return $output;
    }
    public function categoryByAlbum($id){
        $datas = ImageAlbum::find($id)->categories;
         $output = '<option value="">Please Select Your Category</option>';
         foreach($datas as $data){
             $output .= '<option value="'.$data->id.'">'.$data->name.'</option>';
         }
         return $output;
    }
    public function store(Request $request){
        $rules = [
            'language_id' => 'required',
            'image_album_id' => 'required',
            'image_category_id' => 'required',
        ];
        $validation = Validator::make($request->all(),$rules);
        if($validation->fails()){
            return response()->json(['errors'=>$validation->getMessageBag()->toArray()]);
        }
        $language = $request->language_id;
        $album = $request->image_album_id;
        $category = $request->image_category_id;
        if ($files = $request->file('gallery')){
            foreach ($files as  $key => $file){
                $val = $file->getClientOriginalExtension();
                if($val == 'jpeg'|| $val == 'jpg'|| $val == 'png'|| $val == 'svg')
                  {
                    $gallery = new ImageGallery();
                    $name = time().$file->getClientOriginalName();
                    $file->move('assets/images/image-gallery',$name);
                    $gallery['gallery'] = $name;
                    $gallery['language_id'] = $language;
                    $gallery['image_album_id'] = $album;
                    $gallery['image_category_id'] = $category;
                    $gallery->save();
                  }
            }
        }
        $msg = 'Data Added Successfully';
        return response()->json($msg);
    }
    public function edit($id){
        $data = ImageGallery::find($id);
        $languages = Language::orderBy('id','desc')->get();
        return view('admin.image-gallery.edit',compact('data','languages'));
    }
    public function albumByLanguageUpdate($x,$y){
        $datas   = Language::find($x)->albums;
        $gallery = ImageGallery::find($y);
         $output = '<option value="">Please Select Your Album</option>';
         foreach($datas as $data){
            if($data->id == $gallery->image_album_id){
                $msg = 'selected';
            }else{
                $msg = '';
            }
             $output .= '<option value="'.$data->id.'" '.$msg.'>'.$data->album_name.'</option>';
         }
         return $output;
    }
    public function categoryByAlbumUpdate($x,$y){
        $datas = ImageAlbum::find($x)->categories;
        $gallery = ImageGallery::find($y);
         $output = '<option value="">Please Select Your Category</option>';
         foreach($datas as $data){
            if($data->id == $gallery->image_category_id){
                $msg = 'selected';
            }else{
                $msg = '';
            }
             $output .= '<option value="'.$data->id.'" '.$msg.'>'.$data->name.'</option>';
         }
         return $output;
    }
    public function update(Request $request,$id){
        $rules = [
            'language_id' => 'required',
            'image_album_id' => 'required',
            'image_category_id' => 'required',
            'gallery' => 'image|mimes:jpeg,png,jpg,gif,svg',
        ];
        $validation = Validator::make($request->all(),$rules);
        if($validation->fails()){
            return response()->json(['errors'=>$validation->getMessageBag()->toArray()]);
        }
        $data = ImageGallery::find($id);
        $input = $request->all();
        if($request->hasFile('gallery')){
            $file = $request->file('gallery');
            $val = $file->getClientOriginalExtension();
            if($val == 'jpeg'|| $val == 'jpg'|| $val == 'png'|| $val == 'svg')
                  {
                    $name = time().$file->getClientOriginalName();
                    $file->move('assets/images/image-gallery',$name);
                    @unlink('assets/images/image-gallery/'.$data->gallery);
                    $input['gallery'] = $name;
                  }
        }
        $data->update($input);
        $msg = 'Data Updated Successfully';
        return response()->json($msg);
    }

    public function delete($id){
        $data = ImageGallery::find($id);
        @unlink('assets/images/image-gallery/'.$data->gallery);
        $data->delete();
        $msg = 'Data Deleted Successfully';
        return response()->json($msg);

    }
}
