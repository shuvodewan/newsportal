<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Post;
use Datatables;
use App\Models\GeneralSettings;
use Carbon\Carbon;
use Auth;

class ScheduleController extends Controller
{
    public function datatables(){
        $datas = Auth::guard('admin')->user()->posts()
                            ->where('status','=','true') 
                            ->where('schedule_post','=',1)
                            ->where('is_pending','=',0)
                            ->orderBy('id','desc')
                            ->get();
                            
        return Datatables::of($datas)
                            ->addColumn('action', function(Post $data) {
                                $slider = $data->is_slider == 0 ? '<a href="'.route('post.sliderChange',$data->id).'"><i class="fa fa-plus"></i> Add Into Slider</a>' : '<a href="'.route('post.sliderChange',$data->id).'"><i class="fa fa-minus"></i> Remove From Slider</a>';
                                $is_trending = $data->is_trending == 0 ? '<a href="'.route('post.trendingChange',$data->id).'"><i class="fa fa-plus"></i> Add Into Breaking</a>' : '<a href="'.route('post.trendingChange',$data->id).'"><i class="fa fa-minus"></i> Remove Breaking</a>';
                                $is_slider_lefts = $data->is_feature == 0 ? '<a href="'.route('post.feature',$data->id).'"><i class="fa fa-plus"></i> Add into Feature</a>' : '<a href="'.route('post.feature',$data->id).'"><i class="fa fa-minus"></i> Remove Feature</a>';
                                $is_slider_rights = $data->slider_right == 0 ? '<a href="'.route('post.sliderright',$data->id).'"><i class="fa fa-plus"></i> Add into sliderRight</a>' : '<a href="'.route('post.sliderright',$data->id).'"><i class="fa fa-minus"></i> Remove sliderRight</a>';
                                $details = '<a href="'.route('frontend.details',[$data->id,$data->slug]).'"> <i class="fa fa-info-circle" aria-hidden="true"></i> View on Frontend</a>';
                                return '<div class="godropdown"><button class="go-dropdown-toggle"> Actions<i class="fas fa-chevron-down"></i></button><div class="action-list">'.$details.'<a href="'.route('post.edit',$data->id).'"> <i class="fas fa-edit"></i> Edit</a>'.$slider.''.$is_trending.''.$is_slider_lefts.''.$is_slider_rights.'<a href="javascript:;" data-href="'.route('post.delete',$data->id).'" data-toggle="modal" data-target="#confirm-delete" class="delete"><i class="fas fa-trash-alt"></i> Delete</a></div></div>';
                            })
                            ->editColumn('category_id',function(Post $data){
                                $category_id = $data->category_id ? $data->category->title : '';
                                return $category_id;
                            })
                            ->addColumn('checkbox',function(Post $data){
                                $id = $data->id;
                                return $checkbox = $data->id ? '<input type="checkbox" class="form-check-input m-0 p-0 postCheck" value="'.$id.'">':'';
                            })
                            ->editColumn('image_big',function(Post $data){
                                $image_big = $data->image_big ? url('assets/images/post/'.$data->image_big):url('assets/images/noimage.png');
                                return '<img src="'.$image_big.'" alt="Image">';
                            })
                            ->editColumn('language_id',function(Post $data){
                                $language_id = $data->language_id ? '<span class="badge badge-info">'.$data->language->language.'</span>' : '';
                                return $language_id;
                            })
                            ->editColumn('post_type',function(Post $data){
                                $post_type = $data->post_type ? '<span class="badge badge-secondary">'.$data->post_type.'</span>': '';
                                return $post_type;
                            })
                            ->editColumn('admin_id',function(Post $data){
                                $name = $data->admin_id ? $data->admin->name: '';
                                return $name;
                            })
                            ->rawColumns(['image_big','category_id','language_id','post_type','admin_id','checkbox','action'])
                            ->toJson(); //--- Returning Json Data To Client Side
    }
    public function index(){
        return view('admin.schedule.index');
    }

    public function postApprove(){
    $posts = Post::where('schedule_post','=',1)
                        ->where('schedule_post_date','!=',NULL)
                        ->where('is_pending','=',0)
                        ->where('status','=','true')
                        ->get();
    $gs = GeneralSettings::find(1);
        if(count($posts)>0){
            foreach($posts as $post){
                $current_time = Carbon::now($gs->time_zone)->format('Y-m-d H:i:s');
                $today = Carbon::parse($current_time);
                $post_time = $post->schedule_post_date;
                if($today->gt($post_time)){
                    $post->schedule_post_date = NULL;
                    $post->schedule_post = 0;
                    $post->update();
                }
            }
            return redirect()->route('post.index');
        }else{
            return redirect()->route('post.index');
        }

    }
}
