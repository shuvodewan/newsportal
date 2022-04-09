<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Category;
use App\Models\Gallery;
use App\Models\Language;
use App\Models\View;
use Carbon\Carbon;
use Datatables;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function datatables(Request $request){

        $input = $request->all();
        $user = Auth::guard('admin')->user()->role;
        $default_language = Language::where('is_default',1)->first();
        if($user->name != 'admin' && $user->name != 'moderator'){
            if(isset($input['lang']) || isset($input['category'])){
                if(isset($input['lang'])){
                    $datas = Auth::guard('admin')->user()->filterByLanguage($input['lang']); //filterByLanguage in Admin Model
                }
                if(isset($input['category'])){
                    $datas = Auth::guard('admin')->user()->filterByCategory($input['category']);  //filterByCategory in Admin Model  
                }
            }else{
                $datas = Auth::guard('admin')->user()->posts()
                ->where('status','=','true')
                ->where('schedule_post','=',0)
                ->where('schedule_post_date','=',NULL)
                ->orderBy('id','desc')
                ->get();
            }
        }
        else{
            if(isset($input['lang']) || isset($input['category'])){
                if(isset($input['lang'])){
                    $datas = Post::where('status','=','true')
                                    ->where('language_id',$input['lang'])
                                    ->where('schedule_post','=',0)
                                    ->where('schedule_post_date','=',NULL)
                                    ->orderBy('id','desc')
                                    ->get();
                }
                if(isset($input['category'])){
                    $datas = Post::where('status','=','true')
                                    ->where('category_id',$input['category'])
                                    ->where('schedule_post','=',0)
                                    ->where('schedule_post_date','=',NULL)
                                    ->orderBy('id','desc')
                                    ->get();
                }
            }else{
                $datas = Post::where('status','=','true')
                        ->where('schedule_post','=',0)
                        ->where('schedule_post_date','=',NULL)
                        ->orderBy('id','desc')
                        ->get();
            }
        }
        return Datatables::of($datas)
                            ->addColumn('action', function(Post $data) {
                                $slider = $data->is_slider == 0 ? '<a href="'.route('post.sliderChange',$data->id).'"><i class="fa fa-plus"></i> Add Into Slider</a>' : '<a href="'.route('post.sliderChange',$data->id).'"><i class="fa fa-minus"></i> Remove From Slider</a>';
                                $is_trending = $data->is_trending == 0 ? '<a href="'.route('post.trendingChange',$data->id).'"><i class="fa fa-plus"></i> Add Into Breaking</a>' : '<a href="'.route('post.trendingChange',$data->id).'"><i class="fa fa-minus"></i> Remove Breaking</a>';
                                $is_approve = $data->is_pending == 0 ? '<a href="'.route('post.pendingChange',$data->id).'"><i class="fa fa-file"></i> Make Post Pending</a>' : '<a href="'.route('post.pendingChange',$data->id).'"><i class="fa fa-file"></i> Make Post Approve</a>';
                                $is_slider_lefts = $data->is_feature == 0 ? '<a href="'.route('post.feature',$data->id).'"><i class="fa fa-plus"></i> Add into Feature</a>' : '<a href="'.route('post.feature',$data->id).'"><i class="fa fa-minus"></i> Remove Feature</a>';
                                $is_slider_rights = $data->slider_right == 0 ? '<a href="'.route('post.sliderright',$data->id).'"><i class="fa fa-plus"></i> Add into sliderRight</a>' : '<a href="'.route('post.sliderright',$data->id).'"><i class="fa fa-minus"></i> Remove sliderRight</a>';
                                if($data->post_type=='rss'){
                                    $edit = '';
                                }else{
                                    $edit = '<a href="'.route('post.edit',$data->id).'"> <i class="fas fa-edit"></i> Edit</a>';
                                }
                                $details = '<a href="'.route('frontend.details',[$data->id,$data->slug]).'" target="_blank"> <i class="fa fa-info-circle" aria-hidden="true"></i> View on Frontend</a>';
                                return '<div class="godropdown"><button class="go-dropdown-toggle"> Actions<i class="fas fa-chevron-down"></i></button><div class="action-list">'.$details.''.$edit.''.$slider.''.$is_trending.''.$is_slider_lefts.''.$is_slider_rights.''. $is_approve.'<a href="javascript:;" data-href="'.route('post.delete',$data->id).'" data-toggle="modal" data-target="#confirm-delete" class="delete"><i class="fas fa-trash-alt"></i> Delete</a></div></div>';
                            })
                            ->addColumn('checkbox',function(Post $data){
                                $id = $data->id;
                                return $checkbox = $data->id ? '<input type="checkbox" class="form-check-input m-0 p-0 postCheck" value="'.$id.'">':'';
                            })
                            ->editColumn('category_id',function(Post $data){
                                $category_id = $data->category_id ? '<span class="badge badge-primary">'.$data->category->title.'</span>' : '';
                                return $category_id;
                            })
                            ->editColumn('language_id',function(Post $data){
                                $language_id = $data->language_id ? '<span class="badge badge-info">'.$data->language->language.'</span>' : '';
                                return $language_id;
                            })
                            ->addColumn('is_approve',function(Post $data){
                                $is_approve = $data->is_pending == 0 ? '<span class="badge badge-success">approve</span>':'<span class="badge badge-danger">disapprove</span>';
                                return $is_approve;
                            })
                            ->editColumn('post_type',function(Post $data){
                                $post_type = $data->post_type ? '<span class="badge badge-secondary">'.$data->post_type.'</span>': '';
                                return $post_type;
                            })
                            ->editColumn('image_big',function(Post $data){
                                if($data->post_type == 'rss'){
                                    $rss_image = $data->rss_image ?  $data->rss_image:url('assets/images/nopic.png');
                                    return '<img src="'.$rss_image.'" alt="Image">';
                                }else{
                                    $image_big = $data->image_big ? url('assets/images/post/'.$data->image_big):url('assets/images/nopic.png');
                                    return '<img src="'.$image_big.'" alt="Image">';
                                }
                            })
                            ->editColumn('created_at',function(Post $data){
                                $created_at = $data->created_at;
                                return $created_at->toFormattedDateString();
                            })
                            ->editColumn('admin_id',function(Post $data){
                                $name = $data->admin_id ? $data->admin->name: '';
                                return $name;
                            })
                            ->rawColumns(['checkbox','image_big','category_id','language_id','action','is_approve','post_type','created_at','admin_id'])
                            ->toJson(); //--- Returning Json Data To Client Side
    }
    public function index(Request $request){
        return view('admin.post.index');
    }

    public function categoryFilter($id){
        $datas = Language::find($id)->categories()->where('parent_id',NULL)->get();
        $output = '<option data-href="'.route('post.datatables').'?category=&lang='.$id.'">All</option>';
        foreach($datas as $data){
            $output .= '<option data-href="'.route('post.datatables').'?category='.$data->id.'">'.$data->title.'</option>';
        }
        return $output;
    }

    public function edit($id){

        $data = Post::find($id);
        $categories = Category::where('parent_id','=',NULL)->get();
        $languages = Language::orderBy('id','desc')->get();

        if($data->post_type == 'article'){
            return view('admin.article.edit',compact('categories','languages','data'));
        }
        elseif($data->post_type == 'video')
        {
            return view('admin.video.edit',compact('categories','languages','data'));
        }
        elseif($data->post_type == 'Sorted List')
        {
            return view('admin.shortlist.edit',compact('categories','languages','data'));
        }
        elseif($data->post_type == 'Trivia Quiz'){
            return view('admin.quiz.edit',compact('categories','languages','data'));
        }
        elseif($data->post_type == 'Personality Quiz'){
            return view('admin.pquiz.edit',compact('categories','languages','data'));
        }
        else{
            return view('admin.audio.edit',compact('categories','languages','data'));
        }
    }

    public function view($id){
        $data = Post::find($id);
        if($data->post_type == 'article'){
            return view('admin.article.view',compact('data'));
        }
    }

    public function sliderChange($id){
        $data = Post::find($id);

        if($data->is_slider == 1){
           $data->is_slider = 0;
        }else{
            $data->is_slider = 1;
        }
        $data->update();
        return back()->with('success','Slider Status Updated successfully!');
    }

    public function sliderBulk(Request $request){
        $datas =  explode(',',$request->ids);
        foreach($datas as $data){
            $post = Post::findOrFail($data);
            if($post->is_slider == 0){
               $post->update(['is_slider'=> 1]);
            }
        }
        return back()->with('success','Data Updated successfully!');
    }

    public function removesliderBulk(Request $request){
        $datas =  explode(',',$request->ids);
        foreach($datas as $data){
            $post = Post::findOrFail($data);
            if($post->is_slider == 1){
               $post->update(['is_slider'=> 0]);
            }
        }
        return back()->with('success','Data Updated successfully!');
    }

    public function breakingBulk(Request $request){
        $datas =  explode(',',$request->ids);
        foreach($datas as $data){
            $post = Post::findOrFail($data);
            if($post->is_trending == 0){
               $post->update(['is_trending'=> 1]);
            }
        }
        return back()->with('success','Data Updated successfully!');
    }

    public function removebreakingBulk(Request $request){
        $datas =  explode(',',$request->ids);
        foreach($datas as $data){
            $post = Post::findOrFail($data);
            if($post->is_trending == 1){
               $post->update(['is_trending'=> 0]);
            }
        }
        return back()->with('success','Data Updated successfully!');
    }
    public function featureBulk(Request $request){
        $datas =  explode(',',$request->ids);
        foreach($datas as $data){
            $post = Post::findOrFail($data);
            if($post->is_feature == 0){
               $post->update(['is_feature'=> 1]);
            }
        }
        return back()->with('success','Data Updated successfully!');
    }

    public function removefeatureBulk(Request $request){
        $datas =  explode(',',$request->ids);
        foreach($datas as $data){
            $post = Post::findOrFail($data);
            if($post->is_feature == 1){
               $post->update(['is_feature'=> 0]);
            }
        }
        return back()->with('success','Data Updated successfully!');
    }

    public function rightBulk(Request $request){
        $datas =  explode(',',$request->ids);
        foreach($datas as $data){
            $post = Post::findOrFail($data);
            if($post->slider_right == 0){
               $post->update(['slider_right'=> 1]);
            }
        }
        return back()->with('success','Data Updated successfully!');
    }

    public function removerightBulk(Request $request){
        $datas =  explode(',',$request->ids);
        foreach($datas as $data){
            $post = Post::findOrFail($data);
            if($post->slider_right == 1){
               $post->update(['slider_right'=> 0]);
            }
        }
        return back()->with('success','Data Updated successfully!');
    }

    public function trendingChange($id){
        $data = Post::find($id);

        if($data->is_trending == 1){
           $data->is_trending = 0;
        }else{
            $data->is_trending = 1;
        }
        $data->update();
        return back()->with('success','Breaking News Status Updated successfully!');
    }

    public function featureChange($id){
        $data = Post::find($id);

        if($data->is_feature == 1){
           $data->is_feature = 0;
        }else{
            $data->is_feature = 1;
        }
        $data->update();
        return back()->with('success','Data Updated successfully!');
    }

    public function sliderright($id){
        $data = Post::find($id);

        if($data->slider_right == 1){
           $data->slider_right = 0;
        }else{
            $data->slider_right = 1;
        }
        $data->update();
        return back()->with('success','Data Updated successfully!');
    }

    public function pendingChange($id){
        $data = Post::find($id);

        if($data->is_pending == 1){
           $data->is_pending = 0;
        }else{
            $data->is_pending = 1;
        }
        $data->update();
        return back()->with('success','Pending Status Updated successfully!');
    }

    public function delete($id){
        $data = Post::find($id);
        foreach($data->views as $view){
           $view->delete();
        }
        if($data->post_type == 'audio'){
            @unlink('assets/audios/'.$data->audio);
        }
        if($data->post_type == 'video'){
            @unlink('assets/videos/'.$data->video);
        }
        if($data->post_type == 'Trivia Quiz'){
            if($data->tquizs->count()>0){
                foreach ($data->tquizs as $quiz) {
                   if($quiz->answers->count()>0){
                       foreach($quiz->answers as $answer){
                        @unlink('assets/images/quizanswer/'.$answer->answer_photo);
                        $answer->delete(); 
                       }
                   }
                   @unlink('assets/images/quiz/'.$quiz->question_photo);
                   $quiz->delete();
                }
            }
            if($data->tresults->count()>0){
                foreach($data->tresults as $tresult){
                    @unlink('assets/images/quizresult/'.$tresult->result_photo);  
                    $tresult->delete();
                }
            }
        }

        if($data->post_type == 'Personality Quiz'){
            if($data->pquizs->count()>0){
                foreach ($data->pquizs as $quiz) {
                   if($quiz->answers->count()>0){
                       foreach($quiz->answers as $answer){
                        @unlink('assets/images/panswer/'.$answer->answer_photo); 
                        $answer->delete(); 
                       }
                   }
                   @unlink('assets/images/pquiz/'.$quiz->question_photo);
                   $quiz->delete();
                }
            }

            if($data->presults->count()>0){
                foreach($data->presults as $presult){
                    @unlink('assets/images/presult/'.$presult->result_photo); 
                    $presult->delete();
                }
            }
        }

        if($data->post_type == 'Sorted List'){
            if($data->sorts->count()>0){
                foreach($data->sorts as $sort){
                    @unlink('assets/images/sort/'.$sort->item_photo);
                    $sort->delete();
                }
            }
        }

        @unlink('assets/images/post/'.$data->image_big);
        $data->delete();
        $msg = 'Data Successfully Deleted';
        return response()->json($msg);
    }

    public function bulkdelete(Request $request){
        $datas =  explode(',',$request->ids);
        foreach($datas as $data){
            $views = Post::find($data)->views;
            foreach($views as $view){
                $view->delete();
             }
            $post = Post::findOrFail($data);
            if($post->post_type == 'audio'){
                @unlink('assets/audios/'.$data->audio);
            }
            if($post->post_type == 'video'){
                @unlink('assets/videos/'.$data->video);
            }
            if($post->post_type == 'Trivia Quiz'){
                if($post->tquizs->count()>0){
                    foreach ($post->tquizs as $quiz) {
                       if($quiz->answers->count()>0){
                           foreach($quiz->answers as $answer){
                            @unlink('assets/images/quizanswer/'.$answer->answer_photo);
                            $answer->delete(); 
                           }
                       }
                       @unlink('assets/images/quiz/'.$quiz->question_photo);
                       $quiz->delete();
                    }
                }
                if($post->tresults->count()>0){
                    foreach($post->tresults as $tresult){
                        @unlink('assets/images/quizresult/'.$tresult->result_photo);  
                        $tresult->delete();
                    }
                }
            }
    
            if($post->post_type == 'Personality Quiz'){
                if($post->pquizs->count()>0){
                    foreach ($post->pquizs as $quiz) {
                       if($quiz->answers->count()>0){
                           foreach($quiz->answers as $answer){
                            @unlink('assets/images/panswer/'.$answer->answer_photo); 
                            $answer->delete(); 
                           }
                       }
                       @unlink('assets/images/pquiz/'.$quiz->question_photo);
                       $quiz->delete();
                    }
                }
    
                if($post->presults->count()>0){
                    foreach($post->presults as $presult){
                        @unlink('assets/images/presult/'.$presult->result_photo); 
                        $presult->delete();
                    }
                }
            }
    
            if($post->post_type == 'Sorted List'){
                if($post->sorts->count()>0){
                    foreach($post->sorts as $sort){
                        @unlink('assets/images/sort/'.$sort->item_photo);
                        $sort->delete();
                    }
                }
            }
    
            @unlink('assets/images/post/'.$post->image_big);
            $post->delete();
        }
        return back()->with('success','Data Deleted successfully!');
    }
}
