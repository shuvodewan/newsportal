<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Language;
use App\Models\Post;
use App\Models\TriviaAnswer;
use App\Models\TriviaQuestion;
use App\Models\TriviaResult;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Brian2694\Toastr\Facades\Toastr;
use Image;
use Illuminate\Support\Str;

class TQuizController extends Controller
{
    public function create(){
        $datas = Category::where('parent_id','=',NULL)->get();
        $languages = Language::orderBy('id','desc')->get();
        return view('admin.quiz.create',compact('datas','languages'));
    }

    public function store(Request $request){
        // dd($request->all());
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

        if($request->draft == 1){
            $input['status'] = 'draft';
        }else{
            $input['status'] = 'true';
        }

        if($date = $request->schedule_post_date){
            $input['schedule_post_date'] = $date;

        }
        $input['post_type'] = 'Trivia Quiz';
        $data->fill($input)->save();

        $post_id = $data->id; //take last post Id

        $question_title = $request->question_title;
        $question_photo = $request->question_photo;
        $question_description = $request->question_description;

            foreach($question_title as $key=>$value){
                $tq['post_id'] = $post_id;
                $tq['question_title'] = $value;
                if(!empty($question_photo[$key])){
                    $question_photoo = $question_photo[$key];
                    if($file = $question_photoo){
                        $img = Image::make($file->getRealPath())->resize(750, 500);
                        $thumbnail = time().Str::random(8).'.jpg';
                        $img->save(base_path().'/../assets/images/quiz/'.$thumbnail);        
                        $tq['question_photo'] = $thumbnail;
                    }
                }
                $quiz_description = $question_description[$key];
                $tq['question_description'] = $quiz_description;

                $trivia_question_id = DB::table('trivia_questions')->insertGetId($tq);
    
                $trivia_question_id = $trivia_question_id;


                $answer_title = $request->answer_title;
                $correct_answer = $request->correct_answer;
                $answer_photo = $request->answer_photo;
            
                $answer_title = $answer_title[$key+1];

                $photo_key = $key+1;
                $answer_photo_exist = array();
                if($answer_photo){
                    if(array_key_exists($photo_key,$answer_photo)){
                        $answer_photo_exist = $answer_photo[$photo_key];
                    }
                }

                
                $correct_key = $correct_answer[$key+1];
                $i = 1;
                foreach($answer_title as $key=>$value){
                        $ansTitle = $value;
                        $at = new TriviaAnswer();
                        $at->trivia_question_id = $trivia_question_id;
            
                        $at->answer_title = $value;
                            if($correct_key==$i){
                                $at->correct_answer = 1;
                            }else{
                                $at->correct_answer = 0;
                            }

                            if(count($answer_photo_exist) > 0 == true){
                                if(!empty($answer_photo_exist[$key])){
                                $answer_photoo = $answer_photo_exist[$key];
                                if($file = $answer_photoo){
                                    $img = Image::make($file->getRealPath())->resize(370,370);
                                    $thumbnail = time().Str::random(8).'.jpg';
                                    $img->save(base_path().'/../assets/images/quizanswer/'.$thumbnail); 
                                    if($thumbnail){
                                        $at->answer_photo = $thumbnail;
                                    }
                                }
                            }
                        }
                        $at->save();
                        $i++;
                }  
        }

        $result_title = $request->result_title;
        $result_photo = $request->result_photo;
        $result_description = $request->result_description;
        $min = $request->min;
        $max = $request->max;

        foreach($result_title as $key=>$value){
            $data = new TriviaResult();
            $data->post_id = $post_id;
            $data->result_title = $value;
            if(!empty($result_photo[$key])){
                $result_photoo = $result_photo[$key];
                    if($file = $result_photoo){
                        $img = Image::make($file->getRealPath())->resize(750, 500);
                        $thumbnail = time().Str::random(8).'.jpg';
                        $img->save(base_path().'/../assets/images/quizresult/'.$thumbnail);        
                        $data->result_photo = $thumbnail;
                    }
            }
            $data->result_description = $result_description[$key];
            $data->min = $min[$key];
            $data->max = $max[$key];
            $data->save();
        }
        $msg = 'Data Added Successfully';
        return response()->json($msg);
    }

    public function update(Request $request,$id){ 
        // dd($request->all());
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
        };

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

        $admin = Auth::guard('admin')->user()->role_id; //take admin role id 
        $data  =  Post::find($id); 
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

        if($request->draft == 1){
            $input['status'] = 'draft';
        }else{
            $input['status'] = 'true';
        }

        if($date = $request->schedule_post_date){
            $input['schedule_post_date'] = $date;

        }
        $input['post_type'] = 'Trivia Quiz';
        $data->update($input);

        $post_id = $data->id; //take last post Id

        $question_id    = $request->question_id;
        $question_title = $request->question_title;
        $question_photo = $request->question_photo;
        $question_description = $request->question_description;


            foreach($question_title as $key=>$value){
                if(!empty($question_id[$key])){
                    $triviaId = $question_id[$key];
                    $trivia_question = TriviaQuestion::find($triviaId);
                    $trivia_question->post_id = $post_id;
                    $trivia_question->question_title = $value;
    
                    if(!empty($question_photo[$key])){
                        $question_photoo = $question_photo[$key];
                        if($file = $question_photoo){
                            $img = Image::make($file->getRealPath())->resize(750, 500);
                            $thumbnail = time().Str::random(8).'.jpg';
                            $img->save(base_path().'/../assets/images/quiz/'.$thumbnail);
                            @unlink('assets/images/quiz/'.$trivia_question->question_photo);
                            $trivia_question->question_photo = $thumbnail;
                        }
                    }
                    $quiz_description = $question_description[$key];
                    $trivia_question->question_description = $quiz_description;
                    $trivia_question->update();

                    $trivia_question_id = $trivia_question->id;
                }else{
                    $tq['post_id'] = $post_id;
                    $tq['question_title'] = $value;
                    if(!empty($question_photo[$key])){
                        $question_photoo = $question_photo[$key];
                        if($file = $question_photoo){
                            $img = Image::make($file->getRealPath())->resize(750, 500);
                            $thumbnail = time().Str::random(8).'.jpg';
                            $img->save(base_path().'/../assets/images/quiz/'.$thumbnail);        
                            $tq['question_photo'] = $thumbnail;
                        }
                    }
                    $quiz_description = $question_description[$key];
                    $tq['question_description'] = $quiz_description;
    
                    $trivia_question_id = DB::table('trivia_questions')->insertGetId($tq);
                    $trivia_question_id = $trivia_question_id;
                }
    
                $answer_id    = $request->answer_id;
                $answer_title = $request->answer_title;
                $correct_answer = $request->correct_answer;
                $answer_photo = $request->answer_photo;
                
                $answer_id    = $answer_id[$key+1];
                $answer_title = $answer_title[$key+1];

                $answer_photo_exist = array();
                if(!empty($answer_photo)){
                    $photo_key = $key+1;
                    if(array_key_exists($photo_key,$answer_photo)){
                        $answer_photo_exist = $answer_photo[$photo_key];
                    }
                }

                if(!empty($correct_answer[$key+1])){
                    $correct_key  = $correct_answer[$key+1];
                }else{
                    $msg[] = 'please select any option as selected';
                        return response()->json(array('errors' => $msg));
                }
                $i = 1;
                foreach($answer_title as $key=>$value){
                        $ansTitle = $value;
                         $ansId = $answer_id[$key];
                        if($ansId==0){
                            $ansTitle = $value;
                            $at = new TriviaAnswer();
                            $at->trivia_question_id = $trivia_question_id;
                
                            $at->answer_title = $value;
                            
                            if($correct_key==$i){
                                $at->correct_answer = 1;
                            }else{
                                $at->correct_answer = 0;
                            }
    
                                if(count($answer_photo_exist) > 0 == true){
                                    if(!empty($answer_photo_exist[$key])){
                                    $answer_photoo = $answer_photo_exist[$key];
                                    if($file = $answer_photoo){
                                        $img = Image::make($file->getRealPath())->resize(370,370);
                                        $thumbnail = time().Str::random(8).'.jpg';
                                        $img->save(base_path().'/../assets/images/quizanswer/'.$thumbnail); 
                                        if($thumbnail){
                                            $at->answer_photo = $thumbnail;
                                        }
                                    }
                                }
                            }
                            $at->save();
                        }else{
                            $at    = TriviaAnswer::find($ansId);
                            $at->trivia_question_id = $trivia_question_id;
                
                            $at->answer_title = $value;

                            if($correct_key==$i){
                                $at->correct_answer = 1;
                            }else{
                                $at->correct_answer = 0;
                            }
    
                            if(count($answer_photo_exist) > 0 == true){
                                if(!empty($answer_photo_exist[$key])){
                                    $answer_photoo = $answer_photo_exist[$key];
                                    if($file = $answer_photoo){
                                        $img = Image::make($file->getRealPath())->resize(370,370);
                                        $thumbnail = time().Str::random(8).'.jpg';
                                        $img->save(base_path().'/../assets/images/quizanswer/'.$thumbnail); 
                                        @unlink('assets/images/quizanswer/'.$at->answer_photo); 
                                        if($thumbnail){
                                            $at->answer_photo = $thumbnail;
                                        }
                                    }
                                }
                            }
                            $at->update();
                        }
                        $i++;
                }
        }


        $tresult_id = $request->tresult_id;
        $result_title = $request->result_title;
        $result_photo = $request->result_photo;
        $result_description = $request->result_description;
        $min = $request->min;
        $max = $request->max;

        foreach($result_title as $key=>$value){
            if(!empty($tresult_id[$key])){
                $tresultId = $tresult_id[$key];
                $data = TriviaResult::find($tresultId);
                $data->post_id = $post_id;
                $data->result_title = $value;
    
                if(!empty($result_photo[$key])){
                    $result_photoo = $result_photo[$key];
                        if($file = $result_photoo){
                            $img = Image::make($file->getRealPath())->resize(750, 500);
                            $thumbnail = time().Str::random(8).'.jpg';
                            $img->save(base_path().'/../assets/images/quizresult/'.$thumbnail); 
                            @unlink('assets/images/quizresult/'.$data->result_photo);       
                            $data->result_photo = $thumbnail;
                        }
                }
                $data->result_description = $result_description[$key];
                $data->min = $min[$key];
                $data->max = $max[$key];
                $data->update();
            }else{
                $data = new TriviaResult();
                $data->post_id = $post_id;
                $data->result_title = $value;
                if(!empty($result_photo[$key])){
                    $result_photoo = $result_photo[$key];
                        if($file = $result_photoo){
                            $img = Image::make($file->getRealPath())->resize(750, 500);
                            $thumbnail = time().Str::random(8).'.jpg';
                            $img->save(base_path().'/../assets/images/quizresult/'.$thumbnail);        
                            $data->result_photo = $thumbnail;
                        }
                }
                $data->result_description = $result_description[$key];
                $data->min = $min[$key];
                $data->max = $max[$key];
                $data->save();
            }
        }
        $msg = 'Data Updated Successfully';
        return response()->json($msg); 
    }

    public function removequestion($id){
        $data = TriviaQuestion::find($id);

        if($data->answers->count()>0){
            foreach($data->answers as $answer){
                $ans = TriviaAnswer::find($answer->id);
                @unlink('assets/images/quizanswer/'.$ans->answer_photo); 
                $ans->delete();
            }
        }
        $data->delete();
    }

    public function removeresult($id){
        $data = TriviaResult::find($id);
        @unlink('assets/images/quizresult/'.$data->result_photo);
        $data->delete(); 
    }

    public function removeanswer($id){
        $data = TriviaAnswer::find($id);
        @unlink('assets/images/quizanswer/'.$data->answer_photo);
        $data->delete();
    }
}
