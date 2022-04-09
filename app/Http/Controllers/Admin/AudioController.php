<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Language;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Brian2694\Toastr\Facades\Toastr;
use Image;
use Illuminate\Support\Str;

class AudioController extends Controller
{
        public function create(){
            $datas = Category::where('parent_id','=',NULL)->get();
            $languages = Language::orderBy('id','desc')->get();
            return view('admin.audio.create',compact('datas','languages'));
        }

        //fetch categories under the language
        public function language($id){
            $datas    = Language::find($id)->categories()->where('parent_id','=',NULL)->get();
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
            $output = slug_create($val);
            return $output;
        }

        public function store(Request $request){
            $rules = [
                'title' => 'required',
                'slug' => 'required|unique:posts',
                'image_big' => 'image|mimes:jpeg,png,jpg,gif,svg',
                'audio' => 'required|mimes:application/octet-stream,audio/mpeg,mpga,mp3,wav',
                'description' => 'required',
                'category_id' => 'required',
            ];

            $validator = Validator::make($request->all(),$rules);
            if($validator->fails()){
                return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
            }
            $admin = Auth::guard('admin')->user()->role_id;
            $data  = new Post();
            $input = $request->all();
            if($file = $request->file('image_big')){
                $img = Image::make($file->getRealPath())->resize(780,438);
                $thumbnail = time().Str::random(8).'.jpg';
                $img->save(base_path().'/../assets/images/post/'.$thumbnail);        
                $input['image_big'] = $thumbnail;
            }
            if($audio = $request->file('audio')){
                $audioName = time().$audio->getClientOriginalName();
                $audio->move('assets/audios/',$audioName);
                $input['audio'] = $audioName;
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
            $input['post_type'] = 'audio';
            $data->fill($input)->save();
            $msg = 'Audio Added Successfully';
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
                'title' => 'required',
                'slug' => 'required|unique:posts,slug,'.$id,
                'image_big' => 'image|mimes:jpeg,png,jpg,gif,svg',
                'audio' => 'nullable|mimes:application/octet-stream,audio/mpeg,mpga,mp3,wav',
                'description' => 'required',
                'category_id' => 'required',
            ];

            $validator = Validator::make($request->all(),$rules);
            if($validator->fails()){
                return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
            }
            $admin = Auth::guard('admin')->user()->role_id;

            $data  = Post::findOrFail($id);
            $input = $request->all();

            if($file = $request->file('image_big')){
                $img = Image::make($file->getRealPath())->resize(780,438);
                $thumbnail = time().Str::random(8).'.jpg';
                $img->save(base_path().'/../assets/images/post/'.$thumbnail);
                @unlink('assets/images/post/'.$data->image_big);        
                $input['image_big'] = $thumbnail;
            }
            if($request->hasFile('audio')){
                $audio = $request->file('audio');
                $audioName = time().$audio->getClientOriginalName();
                $audio->move('assets/audios/',$audioName);
                @unlink('assets/audios/'.$data->audio);
                $input['audio'] = $audioName;
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
            $input['post_type'] = 'audio';
            $data->update($input);
            $msg = 'Audio updated Successfully';
            return response()->json($msg);
        }

}
