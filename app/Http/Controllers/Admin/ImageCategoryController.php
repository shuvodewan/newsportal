<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ImageAlbum;
use App\Models\ImageCategory;
use App\Models\Language;
use Datatables;
use Illuminate\Support\Facades\Validator;

class ImageCategoryController extends Controller
{
    public function datatables(){
        $datas = ImageCategory::orderBy('id','desc')->get();
        return Datatables::of($datas)
                             ->addColumn('action', function(ImageCategory $data) {
                                 return '<div class="action-list"><a data-href="'.route('image.category.edit',$data->id) .'" class="edit" data-toggle="modal" data-target="#modal1"> <i class="fas fa-edit"></i>Edit</a><a href="javascript:;" data-href="'.route('image.category.delete',$data->id).'" data-toggle="modal" data-target="#confirm-delete" class="delete"><i class="fas fa-trash-alt"></i></a></div>';
                             })
                             ->editColumn('language_id',function(ImageCategory $data){
                                 return $language = $data->language_id ? $data->language->language : '';
                             })
                             ->editColumn('image_album_id',function(ImageCategory $data){
                                return $album = $data->image_album_id ? $data->album->album_name : '';
                            })
                             ->rawColumns(['action','language_id','image_album_id'])
                             ->toJson();
     }
     public function index(){
         return view('admin.image-category.index');
     }
     public function categoryByLanguage($id){
         $datas = Language::find($id)->albums;
         $output = '<option value="">Please Select Your Album</option>';
         foreach($datas as $data){
             $output .= '<option value="'.$data->id.'">'.$data->album_name.'</option>';
         }
         return $output;
     }
     public function create(){
         $languages = Language::orderBy('id','desc')->get();
         return view('admin.image-category.create',compact('languages'));
     }
     public function store(Request $request){
        $rules = [
            'language_id' => 'required',
            'image_album_id' => 'required',
            'name' => 'required|unique:image_categories'
        ];

        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            return response()->json(array('errors'=>$validator->getMessageBag()->toArray()));
        }

         $data  = new ImageCategory();
         $input = $request->all();
         $data->fill($input)->save();
         $msg = 'Data Added Successfully';
         return response()->json($msg);
     }
     public function languageOnUpdate($x,$y){
        $datas = Language::find($x)->albums;
        $image_category = ImageCategory::find($y);
        $output = '<option value="">Please Select Your Album</option>';
        foreach($datas as $data){
            if($data->id == $image_category->image_album_id){
                $msg = 'selected';
            }else{
                $msg = '';
            }
            $output .= '<option value="'.$data->id.'" '.$msg.'>'.$data->album_name.'</option>';
        }
        return $output;
    }
     public function edit($id){
        $data  = ImageCategory::find($id);
        $languages = Language::orderBy('id','desc')->get();
        return view('admin.image-category.edit',compact('data','languages'));
     }
     public function update(Request $request,$id){
        $rules = [
            'language_id' => 'required',
            'image_album_id' => 'required',
            'name' => 'required|unique:image_categories,name,'.$id
        ];

        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            return response()->json(array('errors'=>$validator->getMessageBag()->toArray()));
        }
        
        $data  = ImageCategory::find($id);
        $input = $request->all();
        $data->update($input);
        $msg = 'Data Updated Successfully';
        return response()->json($msg);
    }
    public function delete($id){
        $data  = ImageCategory::find($id)->delete();
        $msg = 'Data Deleted Successfully';
        return response()->json($msg);
    }
}
