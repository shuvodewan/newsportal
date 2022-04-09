<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Language;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Brian2694\Toastr\Facades\Toastr;
use Datatables;

class SubCategoryController extends Controller
{
    public function datatables(){
        
        $datas = Category::where('parent_id','!=',NULL)->orderBy('id','desc')->get();

        //--- Integrating This Collection Into Datatables
        return Datatables::of($datas)
                            ->addColumn('action', function(Category $data) {
                                return '<div class="action-list"><a data-href="'.route('subcategories.edit',$data->id) .'" class="edit" data-toggle="modal" data-target="#modal1"> <i class="fas fa-edit"></i>Edit</a><a href="javascript:;" data-href="'.route('subcategories.delete',$data->id).'" data-toggle="modal" data-target="#confirm-delete" class="delete"><i class="fas fa-trash-alt"></i></a></div>';
                            })
                            ->editColumn('parent_id', function(Category $data){
                                $parent_id = $data->parent_id ? $data->parent->title : '';
                                return $parent_id;
                            })
                            ->editColumn('show_on_menu',function(Category $data){
                                $show_at_homepage = $data->show_on_menu == 1 ? '<span class="btn btn-success btn-sm" style="border-radius: 15px;"> active</span>' : '<span class="btn btn-danger btn-sm" style="border-radius: 15px;"> Inactive</span>';
                                return $show_at_homepage;
                            })
                            ->rawColumns(['action','show_on_menu','parent_id'])
                            ->toJson(); //--- Returning Json Data To Client Side
    }

    public function index(){
        return view('admin.subcategory.index');
    }

    public function create(){
        $default_language = Language::where('is_default',1)->first();
        $categories = Category::where('parent_id','=',NULL)->where('language_id',$default_language->id)->get();
        $datas = Language::orderBy('id','desc')->get();
        return view('admin.subcategory.create',compact('categories','datas'));
    }

    public function store(Request $request){

         //validation area
        $rules =[
            'language_id'=>'required',
            'title' => 'required|unique:categories',
            'parent_id' => 'required',
        ];
        $validator = Validator::make($request->all(),$rules);

        if($validator->fails()){
            return response()->json(['errors'=> $validator->getMessageBag()->toArray()]);
        }
         //validation area end

        $data  = new Category(); 
        $input = $request->all();
        $input['slug'] = slug_create($request->title);
        $data->fill($input)->save();
        $msg = 'Data Added Successfully';
        return response()->json($msg);
    }

    public function edit($id){
        $data = Category::find($id);
        $default_language = Language::where('is_default',1)->first();
        $categories = Category::where('parent_id','=',NULL)->where('language_id',$default_language->id)->get();
        return view('admin.subcategory.edit',compact('data','categories'));
    }

    public function languageOnUpdate( $x, $y){
        $datas = Language::find($x)->categories()->where('parent_id','=',NULL)->get();
        $subCategory = Category::find($y)->parent->id;
        $output = '<option value="">Please Select a Category *</option>';
        foreach($datas as $data){
            if($data->id == $subCategory){
                $msg = 'selected';
            }else{
                $msg = '';
            }
            $output .= '<option value="'.$data->id.'" '.$msg.'>'.$data->title.'</option>';
        }
        return $output;
    }

    public function update(Request $request,$id){
         //validation area
         $rules =[
            'title' => 'required|unique:categories,title,'.$id,
            'slug' => 'required|unique:categories,slug,'.$id,
            'parent_id' => 'required',
        ];
        $validator = Validator::make($request->all(),$rules);

        if($validator->fails()){
            return response()->json(['errors'=> $validator->getMessageBag()->toArray()]);
        }
         //validation area end
        
         $data = Category::find($id); 
         $input = $request->all(); 
         if($slg = $request->title){
             $input['slug'] = slug_create($slg);
         }
         $input['slug'] = slug_create($request->slug);

         $data->update($input);     
         $msg = 'Data Updated Successfully';
         return response()->json($msg);

    }

    public function delete($id){
        $data  = Category::findOrFail($id); // delete a record by id
        foreach($data->subcategoryPosts as $post){
            $post->delete();
        }
        $data->delete();
        $msg = 'Data Successfully Deleted';
        return response()->json($msg);
    }
}
