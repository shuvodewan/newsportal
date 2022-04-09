<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Language;
use App\Models\PersonalityAnswer;
use App\Models\PersonalityResult;
use App\Models\PersonalityQuestion;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Brian2694\Toastr\Facades\Toastr;
use Image;
use Illuminate\Support\Str;

class PQuizController extends Controller
{
    public function create(){
        $datas = Category::where('parent_id','=',NULL)->get();
        $languages = Language::orderBy('id','desc')->get();
        return view('admin.pquiz.create',compact('datas','languages'));
    }

    public function store(Request $request){ 
        $rules = [
            'language_id' => 'required',
            'title' => 'required',
            'slug' => 'required|unique:posts',
            'image_big' => 'image|mimes:jpeg,png,jpg,gif,svg',
            'description' => 'required',
            'category_id' => 'required',
            'question_title.*' => 'required',
            'question_photo.*' => 'image|mimes:jpeg,png,jpg,gif,svg',
            'result_title.*' => 'required',
            'result_photo.*' => 'image|mimes:jpeg,png,jpg,gif,svg',
        ];
        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }


        $answer_titles = $request->answer_title;
        if($answer_titles){
            foreach($answer_titles as $titles){
                foreach($titles as $title){
                    if(!$title){
                        $validate_title[] = 'answer title is required';
                        return response()->json(array('errors' => $validate_title));
                    }
                }
            }
        }

        $photoss = $request->answer_photo;
        if($photoss){
            foreach($photoss as $photos){
                foreach($photos as $photo){
                    $val = $photo->getClientOriginalExtension();
                    if(!($val == 'jpeg'|| $val == 'jpg'|| $val == 'png'|| $val == 'svg')){
                        $msg[] = 'Answer photo must be type of jpeg,png,jpg,gif,svg';
                        return response()->json(array('errors' => $msg));
                    }
                }
            }
        }

        $answer_options = $request->answer_option;
        if($answer_options){
            foreach($answer_options as $options){
                foreach($options as $option){
                    if(!$option){
                        $validate_option[] = 'answer option is required';
                        return response()->json(array('errors' => $validate_option));
                    }
                }
            }
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
        $input['post_type'] = 'Personality Quiz';
        $data->fill($input)->save();

        $post_id = $data->id; //take last post Id


        $result_title = $request->result_title;
        $result_photo = $request->result_photo;
        $result_description = $request->result_description;

        foreach($result_title as $key=>$value){
            $data = new PersonalityResult();
            $data->post_id = $post_id;
            $data->result_title = $value;

            if(!empty($result_photo[$key])){
                $result_photoo = $result_photo[$key];
                if(!empty($result_photoo)){
                    if($file = $result_photoo){
                        $img = Image::make($file->getRealPath())->resize(750, 500);
                        $thumbnail = time().Str::random(8).'.jpg';
                        $img->save(base_path().'/../assets/images/presult/'.$thumbnail);        
                        $data->result_photo = $thumbnail;
                    }
                }
            }
            $data->result_description = $result_description[$key];
            $data->save();
        }

        $question_title = $request->question_title;
        $questionPhoto = $request->question_photo;
        $question_description = $request->question_description;

            foreach($question_title as $key=>$value){
                $pq['post_id'] = $post_id;
                $pq['question_title'] = $value;
                if(isset($questionPhoto[$key])){
                    $question_photoo = $questionPhoto[$key];
                    if($file = $question_photoo){
                        $img = Image::make($file->getRealPath())->resize(750, 500);
                        $thumbnail = time().Str::random(8).'.jpg';
                        $img->save(base_path().'/../assets/images/pquiz/'.$thumbnail);        
                        $pq['question_photo'] = $thumbnail;
                    }
                }else{
                    $pq['question_photo'] = NULL;
                }
                $quiz_description = $question_description[$key];
                $pq['question_description'] = $quiz_description;

                $personality_question_id = DB::table('personality_questions')->insertGetId($pq);
    
                $personality_question_id = $personality_question_id;
                $answer_title = $request->answer_title;
                $answer_option = $request->answer_option;
                $answer_photo = $request->answer_photo;
                
                $answer_titlee = $answer_title[$key+1];

                $photo_key = $key+1;
                $answer_photo_exist = array();
                if($answer_photo){
                    if(array_key_exists($photo_key,$answer_photo)){
                        $answer_photo_exist = $answer_photo[$photo_key];
                    }
                }

                $answer_ooption = $answer_option[$key+1];
                
                foreach($answer_titlee as $key=>$value){
                        $ansTitle = $value;
                        $pa = new PersonalityAnswer();
                        $pa->personality_question_id = $personality_question_id;
                        $pa->answer_title = $value;

                        if(count($answer_photo_exist) > 0 == true){
                            if(!empty($answer_photo_exist[$key])){
                                $answer_photoo = $answer_photo_exist[$key];
                                if($file = $answer_photoo){
                                    $img = Image::make($file->getRealPath())->resize(370,370);
                                    $thumbnail = time().Str::random(8).'.jpg';
                                    $img->save(base_path().'/../assets/images/panswer/'.$thumbnail); 
                                    if($thumbnail){
                                        $pa->answer_photo = $thumbnail;
                                    } 
                                }
                            }
                        }
                        $pa->answer_option = $answer_ooption[$key];
                        $pa->save();
                }
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
            'question_title.*' => 'required',
            'question_photo.*' => 'image|mimes:jpeg,png,jpg,gif,svg',
            'result_title.*' => 'required',
            'result_photo.*' => 'image|mimes:jpeg,png,jpg,gif,svg',
        ];
        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }

        $answer_titles = $request->answer_title;
        if($answer_titles){
            foreach($answer_titles as $titles){
                foreach($titles as $title){
                    if(!$title){
                        $validate_title[] = 'answer title is required';
                        return response()->json(array('errors' => $validate_title));
                    }
                }
            }
        }

        $photoss = $request->answer_photo;
        if($photoss){
            foreach($photoss as $photos){
                foreach($photos as $photo){
                    $val = $photo->getClientOriginalExtension();
                    if(!($val == 'jpeg'|| $val == 'jpg'|| $val == 'png'|| $val == 'svg')){
                        $msg[] = 'Answer photo must be type of jpeg,png,jpg,gif,svg';
                        return response()->json(array('errors' => $msg));
                    }
                }
            }
        }

        $answer_options = $request->answer_options;
        if($answer_options){
            foreach($answer_options as $options){
                foreach($options as $option){
                    if(!$option){
                        $validate_option[] = 'answer option is required';
                        return response()->json(array('errors' => $validate_option));
                    }
                }
            }
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
        $input['post_type'] = 'Personality Quiz';
        $data->update($input);

        $post_id = $data->id; //take last post Id


        $presult_id = $request->presult_id;
        $result_title = $request->result_title;
        $result_photo = $request->result_photo;
        $result_description = $request->result_description;

        foreach($result_title as $key=>$value){
            if(!empty($presult_id[$key])){
                $presultId = $presult_id[$key];
                $data = PersonalityResult::find($presultId);
                $data->post_id = $post_id;
                $data->result_title = $value;
                if(!empty($result_photo[$key])){
                    $result_photoo = $result_photo[$key];
                    if(!empty($result_photoo)){
                        if($file = $result_photoo){
                            $img = Image::make($file->getRealPath())->resize(750, 500);
                            $thumbnail = time().Str::random(8).'.jpg';
                            $img->save(base_path().'/../assets/images/presult/'.$thumbnail); 
                            @unlink('assets/images/presult/'.$data->result_photo);       
                            $data->result_photo = $thumbnail;
                        }
                    }
                }
                $data->result_description = $result_description[$key];
                $data->update();
            }else{
                $data = new PersonalityResult();
                $data->post_id = $post_id;
                $data->result_title = $value;
    
                if(!empty($result_photo[$key])){
                    $result_photoo = $result_photo[$key];
                    if(!empty($result_photoo)){
                        if($file = $result_photoo){
                            $img = Image::make($file->getRealPath())->resize(750, 500);
                            $thumbnail = time().Str::random(8).'.jpg';
                            $img->save(base_path().'/../assets/images/presult/'.$thumbnail);        
                            $data->result_photo = $thumbnail;
                        }
                    }
                }
                $data->result_description = $result_description[$key];
                $data->save();
            }
        }

        $question_id    = $request->question_id;
        $question_title = $request->question_title;
        $questionPhoto = $request->question_photo;
        $question_description = $request->question_description;

            foreach($question_title as $key=>$value){
                if(!empty($question_id[$key])){
                    $personalityId = $question_id[$key];
                    $personality_question = PersonalityQuestion::find($personalityId);
                    $personality_question->post_id = $post_id;
                    $personality_question->question_title = $value;
                    if(isset($questionPhoto[$key])){
                        $question_photoo = $questionPhoto[$key];
                        if($file = $question_photoo){
                            $img = Image::make($file->getRealPath())->resize(750, 500);
                            $thumbnail = time().Str::random(8).'.jpg';
                            $img->save(base_path().'/../assets/images/pquiz/'.$thumbnail);
                            @unlink('assets/images/pquiz/'.$personality_question->question_photo);        
                            $personality_question->question_photo = $thumbnail;
                        }
                    }else{
                        $personality_question->question_photo = NULL;
                    }
                    $quiz_description = $question_description[$key];
                    $personality_question->question_description = $quiz_description;
                    $personality_question->update();
                    $personality_question_id = $personality_question->id;

                }else{
                    $pq['post_id'] = $post_id;
                    $pq['question_title'] = $value;
                    if(isset($questionPhoto[$key])){
                        $question_photoo = $questionPhoto[$key];
                        if($file = $question_photoo){
                            $img = Image::make($file->getRealPath())->resize(750, 500);
                            $thumbnail = time().Str::random(8).'.jpg';
                            $img->save(base_path().'/../assets/images/pquiz/'.$thumbnail);        
                            $pq['question_photo'] = $thumbnail;
                        }
                    }else{
                        $pq['question_photo'] = NULL;
                    }
                    $quiz_description = $question_description[$key];
                    $pq['question_description'] = $quiz_description;
    
                    $personality_question_id = DB::table('personality_questions')->insertGetId($pq);
        
                    $personality_question_id = $personality_question_id;
                }

                $answer_id    = $request->answer_id;
                $answer_title = $request->answer_title;
                $answer_option = $request->answer_option;
                $answer_photo = $request->answer_photo;
                
                $answer_id = $answer_id[$key+1];
                $answer_titlee = $answer_title[$key+1];

                $answer_photo_exist = array();
                if(!empty($answer_photo)){
                    $photo_key = $key+1;
                    if(array_key_exists($photo_key,$answer_photo)){
                        $answer_photo_exist = $answer_photo[$photo_key];
                    }
                }

                $answer_ooption = $answer_option[$key+1];
                
                foreach($answer_titlee as $key=>$value){
                    $ansId = $answer_id[$key];
                        if($ansId==0){
                            $ansTitle = $value;
                            $pa = new PersonalityAnswer();
                            $pa->personality_question_id = $personality_question_id;
                            $pa->answer_title = $value;
    
                            if(count($answer_photo_exist) > 0 == true){
                                if(!empty($answer_photo_exist[$key])){
                                    $answer_photoo = $answer_photo_exist[$key];
                                    if($file = $answer_photoo){
                                        $img = Image::make($file->getRealPath())->resize(370,370);
                                        $thumbnail = time().Str::random(8).'.jpg';
                                        $img->save(base_path().'/../assets/images/panswer/'.$thumbnail); 
                                        if($thumbnail){
                                            $pa->answer_photo = $thumbnail;
                                        } 
                                    }
                                }
                            }
                            $pa->answer_option = $answer_ooption[$key];
                            $pa->save();
                        }else{
                            $ansTitle = $value;
                            $pa = PersonalityAnswer::find($ansId);
                            $pa->personality_question_id = $personality_question_id;
                            $pa->answer_title = $value;
                        
                            if(count($answer_photo_exist) > 0 == true){
                                if(!empty($answer_photo_exist[$key])){
                                    $answer_photoo = $answer_photo_exist[$key];
                                    if($file = $answer_photoo){
                                        $img = Image::make($file->getRealPath())->resize(370,370);
                                        $thumbnail = time().Str::random(8).'.jpg';
                                        $img->save(base_path().'/../assets/images/panswer/'.$thumbnail);  
                                        @unlink('assets/images/panswer/'.$pa->answer_photo); 
                                        $pa->answer_photo = $thumbnail;
                                    }
                                }
                            }
                            $pa->answer_option = $answer_ooption[$key];
                            $pa->update();
                        }
                }
        }
        $msg = 'Data Updated Successfully';
        return response()->json($msg);
    }

    
    public function removepquestion($id){
        $data = PersonalityQuestion::find($id);

        if($data->answers->count()>0){
            foreach($data->answers as $answer){
                $pt = PersonalityAnswer::find($answer->id);
                @unlink('assets/images/panswer/'.$pt->answer_photo);
                $pt->delete();
            }
        }
        $data->delete();
    }

    public function removepresult($id){
        $data = PersonalityResult::find($id);
        @unlink('assets/images/presult/'.$data->result_photo);
        $data->delete(); 
    }

    public function removeanswer($id){
        $data = PersonalityAnswer::find($id);
        @unlink('assets/images/panswer/'.$data->answer_photo);
        $data->delete();
    }
}
