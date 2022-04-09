<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Models\Post;
use Datatables;
use Auth;

class SliderController extends Controller
{
    public function datatables(Request $request){
        $input = $request->all();
        $user = Auth::guard('admin')->user()->role;
        $default_language = Language::where('is_default',1)->first();
        if($user->name != 'admin' && $user->name != 'moderator'){
            if(isset($input['lang']) || isset($input['category'])){
                if(isset($input['lang'])){
                    $datas = Auth::guard('admin')->user()->posts()
                                ->where('is_slider','=',1)
                                ->where('is_pending','=',0)
                                ->where('status','=','true')
                                ->where('language_id',$input['lang'])
                                ->orderBy('id','desc')
                                ->get();
                }
                if(isset($input['category'])){
                    $datas = Auth::guard('admin')->user()->posts()
                                ->where('is_slider','=',1)
                                ->where('is_pending','=',0)
                                ->where('status','=','true')
                                ->where('category_id',$input['category'])
                                ->orderBy('id','desc')
                                ->get();
                }
            }else{
                $datas = Auth::guard('admin')->user()->posts()
                            ->where('is_slider','=',1)
                            ->where('is_pending','=',0)
                            ->where('status','=','true')
                            ->where('language_id',$default_language->id)
                            ->orderBy('id','desc')
                            ->get();
            }
        }else{
            if(isset($input['lang']) || isset($input['category'])){
                if(isset($input['lang'])){
                    $datas = Post::where('is_slider','=',1)
                                ->where('is_pending','=',0)
                                ->where('status','=','true')
                                ->where('language_id',$input['lang'])
                                ->orderBy('id','desc')
                                ->get();
                }
                if(isset($input['category'])){
                    $datas = Post::where('is_slider','=',1)
                                ->where('is_pending','=',0)
                                ->where('status','=','true')
                                ->where('category_id',$input['category'])
                                ->orderBy('id','desc')
                                ->get();
                }
            }else{
                $datas = Post::where('is_slider','=',1)
                ->where('is_pending','=',0)
                ->where('status','=','true')
                ->where('language_id',$default_language->id)
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
                            ->editColumn('category_id',function(Post $data){
                                $category_id = $data->category_id ? '<span class="badge badge-primary">'.$data->category->title.'</span>' : '';
                                return $category_id;
                            })
                            ->addColumn('checkbox',function(Post $data){
                                $id = $data->id;
                                return $checkbox = $data->id ? '<input type="checkbox" class="form-check-input m-0 p-0 postCheck" value="'.$id.'">':'';
                            })
                            ->editColumn('image_big',function(Post $data){
                                if($data->post_type == 'rss'){
                                    $rss_image = $data->rss_image ?  $data->rss_image:url('assets/images/nopic.png');
                                    return '<img src="'.$rss_image.'" alt="Image">';
                                }else{
                                    $image_big = $data->image_big ? url('assets/images/post/'.$data->image_big):url('assets/images/noimage.png');
                                    return '<img src="'.$image_big.'" alt="Image">';
                                }
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
                            ->editColumn('created_at',function(Post $data){
                                $created_at = $data->created_at;
                                return $created_at->toFormattedDateString();
                            })
                            ->rawColumns(['image_big','category_id','language_id','post_type','admin_id','action','checkbox','created_at'])
                            ->toJson(); //--- Returning Json Data To Client Side
    }
    public function index(){
        return view('admin.slider.index');
    }

    public function categoryFilter($id){
        $datas = Language::find($id)->categories()->where('parent_id',NULL)->get();
        $output = '<option data-href="'.route('slider.datatables').'?category=&lang='.$id.'">All</option>';
        foreach($datas as $data){
            $output .= '<option data-href="'.route('slider.datatables').'?category='.$data->id.'">'.$data->title.'</option>';
        }
        return $output;
    }
}
