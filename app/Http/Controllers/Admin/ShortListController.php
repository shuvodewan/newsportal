<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Language;
use App\Models\Post;
use App\Models\ShortList;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Brian2694\Toastr\Facades\Toastr;
use Image;
use Illuminate\Support\Str;

class ShortListController extends Controller
{
    public function create(){
        $datas = Category::where('parent_id','=',NULL)->get();
        $languages = Language::orderBy('id','desc')->get();
        return view('admin.shortlist.create',compact('datas','languages'));
    }

    public function store(Request $request){ 
        $rules = [
            'language_id' => 'required',
            'title' => 'required',
            'slug' => 'required|unique:posts',
            'image_big' => 'image|mimes:jpeg,png,jpg,gif,svg',
            'description' => 'required',
            'category_id' => 'required',
            'item_title[].*' => 'required',
            'item_photo.*' => 'image|mimes:jpeg,png,jpg,gif,svg',
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
        $input['post_type'] = 'Sorted List';
        $data->fill($input)->save();

        $post_id = $data->id; //take last post Id

        $item_title = $request->item_title;
        $item_photo = $request->item_photo;
        $item_description = $request->item_description;


            foreach($item_title as $key=>$value){
                $st = new ShortList();
                $st->post_id = $post_id;
                $st->item_title = $value;
                $item_photoo = $item_photo[$key];
                if($file = $item_photoo){
                    $img = Image::make($file->getRealPath())->resize(750, 500);
                    $thumbnail = time().Str::random(8).'.jpg';
                    $img->save(base_path().'/../assets/images/sort/'.$thumbnail);        
                    $st->item_photo = $thumbnail;
                }
                $description = $item_description[$key];
                $st->item_description = $description;
                $st->save();

        }

        $msg = 'Data Added Successfully';
        return response()->json($msg);
    }

    public function update(Request $request,$id){
        
        $rules = [
            'language_id' => 'required',
            'title' => 'required',
            'slug' => 'required|unique:posts,slug,'.$id,
            'image_big' => 'image|mimes:jpeg,png,jpg,gif,svg',
            'description' => 'required',
            'category_id' => 'required',
            'item_title[].*' => 'required',
            'item_photo.*' => 'image|mimes:jpeg,png,jpg,gif,svg',
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
            $input['schedule_post_date'] = $date;

        }
        $input['post_type'] = 'Sorted List';
        $data->update($input);

        $post_id = $data->id; //take last post Id

        $sort_id    = $request->sort_id;
        $item_title = $request->item_title;
        $item_photo = $request->item_photo;
        $item_description = $request->item_description;


            foreach($item_title as $key=>$value){
                $sortId = $sort_id[$key];
                $st = ShortList::find($sortId);
                $st->post_id = $post_id;
                $st->item_title = $value;
                $item_photoo = $item_photo[$key];
                if($file = $item_photoo){
                    $img = Image::make($file->getRealPath())->resize(750, 500);
                    $thumbnail = time().Str::random(8).'.jpg';
                    $img->save(base_path().'/../assets/images/sort/'.$thumbnail); 
                    @unlink('assets/images/sort/'.$st->item_photo);       
                    $st->item_photo = $thumbnail;
                }
                $description = $item_description[$key];
                $st->item_description = $description;
                $st->update();

        }

        $msg = 'Data Updated Successfully';
        return response()->json($msg);
    }

    public function remove($id){
        $data = ShortList::find($id);
        @unlink('assets/images/sort/'.$data->item_photo);
        $data->delete();
    }
}
