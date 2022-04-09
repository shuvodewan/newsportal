<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Gallery;
use App\Models\Language;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Brian2694\Toastr\Facades\Toastr;
use Image;
use Purifier;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    //Create article page
    public function create(){
        $datas = Category::where('parent_id','=',NULL)->get();
        $languages = Language::orderBy('id','desc')->get();
        return view('admin.article.create',compact('datas','languages'));
    }

    //fetch categories under the language
    public function language($id){
        $datas = Language::find($id)->categories()->where('parent_id','=',NULL)->get();
        $output = '<option value="">Please Select a Category *</option>';
        foreach($datas as $data){
            $output .= '<option value="'.$data->id.'">'.$data->title.'</option>';
        }
        return $output;
    }

    //fetch subcategories under category
    public function subcategory($id){

        $datas = Category::find($id)->child;
        $output = '<option value="">Please Select a SubCategory (if any)</option>';
        foreach($datas as $data){
            $output .= '<option value="'.$data->id.'">'.$data->title.'</option>';
        }
        return $output;
    }

    public function subcategoryUpdate($id,$y){
        $datas = Category::find($id)->child;
        $post = Post::find($y);
        $output = '<option value="">Please Select a SubCategory (if any)</option>';
        foreach($datas as $data){
            if($data->id == $post->subcategories_id){
                $msg = 'selected';
            }else{
                $msg = '';
            }
            $output .= '<option value="'.$data->id.'" '.$msg.'>'.$data->title.'</option>';
        }
        return $output;
    }

    //slug create 
    public function slugCreate(Request $request){
        $data = 1;
        $val =  $request->title;
        $output = slug_create($val); //slug_create() from helper.php
        return $output;
    }


    //Store Data to the database
    public function store(Request $request){       
        $rules = [
            'language_id' => 'required',
            'title' => 'required',
            'slug' => 'required|unique:posts',
            'image_big' => 'image|mimes:jpeg,png,jpg,gif,svg',
            'description' => 'required',
            'category_id' => 'required',
            'gallery.*' => 'image|mimes:jpeg,png,jpg,gif,svg',
        ];
        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        
        $admin = Auth::guard('admin')->user()->role_id; //take admin role id
        $data  = new Post();
        $input = $request->all();

        if($file = $request->file('image_big')){
            $img = Image::make($file->getRealPath())->resize(780,438);
            $thumbnail = time().Str::random(8).'.jpg';
            $img->save(base_path().'/../assets/images/post/'.$thumbnail);        
            $input['image_big'] = $thumbnail;
        }

        $auth_id  = Auth::guard('admin')->user()->id;
        $user = Auth::guard('admin')->user()->role;
        if($user->name == 'admin' || $user->name == 'moderator')
        {
            $input['admin_id']   = $auth_id;
            $input['is_pending'] = 0;
        }else{
            $input['admin_id']   = $auth_id ;
            $input['is_pending'] = 1;
        }

        //check post is trying to put into draft
        if($request->draft == 1){
            $input['status'] = 'draft';
        }else{
            $input['status'] = 'true';
        }

        //check is it schedule post or not
        if($date = $request->schedule_post_date){
            $input['schedule_post_date'] = $date;

        }
        $input['post_type'] = 'article';
        $data->fill($input)->save();

        $lastid = $data->id; //take last post Id

        //Make post Gallery
        if ($files = $request->file('gallery')){
            foreach ($files as  $key => $file){
                    $gallery = new Gallery;
                    $img = Image::make($file->getRealPath())->resize(780,438);
                    $thumbnail = time().Str::random(8).'.jpg';
                    $img->save(base_path().'/../assets/images/galleries/'.$thumbnail); 
                    $gallery['photo'] = $thumbnail;
                    $gallery['post_id'] = $lastid;
                    $gallery->save();
            }
        }
        $msg = 'Article Added Successfully';
        return response()->json($msg);
    }

    public function languageOnUpdate( $x, $y){
        $datas = Language::find($x)->categories()->where('parent_id','=',NULL)->get();
        $post = Post::find($y);
        $output = '<option value="">Please Select a Category *</option>';
        foreach($datas as $data){
            if($data->id == $post->category_id){
                $msg = 'selected';
            }else{
                $msg = '';
            }
            $output .= '<option value="'.$data->id.'" '.$msg.'>'.$data->title.'</option>';
        }
        return $output;
    }

    public function update(Request $request,$id){

        $rules = [
            'language_id' => 'required',
            'title' => 'required',
            'slug' => 'required|unique:posts,slug,'.$id,
            'image_big' => 'image|mimes:jpeg,png,jpg,gif,svg',
            'description' => 'required',
            'category_id' => 'required',
        ];
        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        $admin = Auth::guard('admin')->user()->role_id; //take admin role id
        $data  = Post::find($id);

        $input = $request->all();

        if($file = $request->file('image_big')){
            $img = Image::make($file->getRealPath())->resize(780,438);
            $thumbnail = time().Str::random(8).'.jpg';
            $img->save(base_path().'/../assets/images/post/'.$thumbnail);
            @unlink('assets/images/post/'.$data->image_big);        
            $input['image_big'] = $thumbnail;
        }
        

        $auth_id  = Auth::guard('admin')->user()->id;

        $user = Auth::guard('admin')->user()->role;
        if($user->name == 'admin' || $user->name == 'moderator')
        {
            $input['admin_id']   = $auth_id;
            $input['is_pending'] = 0;
        }else{
            $input['admin_id']   = $auth_id ;
            $input['is_pending'] = 1;
        }

        //check post is trying to put into draft
        if($request->draft == 1){
            $input['status'] = 'draft';
        }else{
            $input['status'] = 'true';
        }

        //check is it schedule post or not
        if($date = $request->schedule_post_date){
            $input['schedule_post_date'] = Carbon::createFromFormat('Y-m-d H:i:s',$date);;

        }
        $input['post_type'] = 'article';
        $data->update($input);
        $msg = 'Data Updated successfully';
        return response()->json($msg);
    }
    
}
