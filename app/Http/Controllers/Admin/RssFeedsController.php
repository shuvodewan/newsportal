<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Language;
use App\Models\Post;
use App\Models\Rss;
use Brian2694\Toastr\Facades\Toastr;
use Datatables;
use SimpleXMLElement;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class RssFeedsController extends Controller
{
    public function datatables(){
        $datas = Rss::orderBy('id','desc')->get();
        return Datatables::of($datas)
                                ->addColumn('action', function(Rss $data) {
                                    return '<div class="action-list"><a data-href="'.route('rss.edit',$data->id) .'" class="edit" data-toggle="modal" data-target="#modal1"> <i class="fas fa-edit"></i>Edit</a><a href="javascript:;" data-href="'.route('rss.delete',$data->id).'" data-toggle="modal" data-target="#confirm-delete" class="delete"><i class="fas fa-trash-alt"></i></a></div>';
                                })
                                ->editColumn('language_id',function(Rss $data){
                                    return $language = $data->language_id ? $data->language->language : '';
                                })
                                ->editColumn('category_id',function(Rss $data){
                                    return $category = $data->category_id ? $data->category->title : '';
                                })
                                ->editColumn('auto_update',function(Rss $data){
                                    return $auto = $data->auto_update == 0 ? '<a href="'.route('rss.feedUpdate',$data->id).'" class="btn btn-sm btn-info"><i class="fas fa-sync-alt"></i>Update</a>':'<button class="btn btn-sm btn-success" disabled="disabled"><i class="fas fa-sync-alt"></i>Auto Updated</button>';
                                })
                                ->rawColumns(['action','language_id','auto_update'])
                                ->toJson();
    }
    public function index(){
        return view('admin.rss.index');
    }

    public function create(){
        $languages = Language::orderBy('id','desc')->get();
        return view('admin.rss.create',compact('languages'));
    }

    public function categoryByLanguage($id){
        $datas = Language::find($id)->categories;
        $output = '<option value="">Please Select Your Category</option>';
        foreach($datas as $data){
            $output .= '<option value="'.$data->id.'">'.$data->title.'</option>';
        }
        return $output;
    }

    public function store(Request $request){
        //validation area
        $rules = [
            'language_id'=>'required',
            'category_id' => 'required',
            'feed_name' => 'required',
            'feed_url' => 'required',
            'post_limit' => 'required',
        ];

        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            return response()->json(['errors' => $validator->getMessageBag()->toArray()]);
        }
        //validation area end
        $data  = new Rss();
        $input = $request->all();
        $data->fill($input)->save();
        
        $lastRecord = Rss::orderBy('id','desc')->first();
        $feed = \Feeds::make($lastRecord->feed_url);

        $items = $feed->get_items(); //grab all items inside the rss
        $i =0;
        foreach($items as $item):
            if($i==$lastRecord->post_limit){
                break;
            }             
            $title =  $item->get_title(); 
            if($title){
               $titleCheck = Post::where('title',$title)->get();
               $totaltitle =  count($titleCheck);
                if($totaltitle == 0){
                    $post = new Post();
                    $post->language_id  = $lastRecord->language_id;
                    $post->title        = $title;
                    $post->slug         = slug_create($title);
                    $post->post_type    = 'rss';
                    $post->is_feature   = 0;
                    $post->is_slider    = 0;
                    $post->slider_left  = 0;
                    $post->slider_right = 0;
                    $post->is_trending  = 0;
                    $post->description  = $item->get_description();
    
                    if ($enclosure = $item->get_enclosure(0)) {
        
                        $type = $enclosure->get_real_type();
                        // Is it a Image?
                        if (stristr($type, 'image/')) {
                            if (empty($enclosure)) {
                                $post->rss_image = '';
                            }
                        $post->rss_image = $enclosure->get_link();
                        }
                    }
                    $post->category_id        = $lastRecord->category_id;
                    $post->schedule_post      = 0;
                    $post->schedule_post      = 0;
                    $post->schedule_post_date = NULL;
                    $post->is_pending         = 0;
                    $post->admin_id           = 1;
                    $post->status             = true;
                    $post->is_draft           = 0;
                    $post->rss_link           = $item->get_permalink();
                    $post->save();
                } 
            }
                $i++;
        endforeach;

        $msg = 'Data Added Successfully';
        return response()->json($msg);
    }
    public function edit($id){
        $data  = Rss::find($id);
        $languages = Language::orderBy('id','desc')->get();
        return view('admin.rss.edit',compact('data','languages'));
    }
    public function categoryByLanguageUpdate($x,$y){
        $datas = Language::find($x)->categories;
        $category = Rss::find($y);
        $output = '<option value="">Please Select Your Album</option>';
        foreach($datas as $data){
            if($data->id == $category->category_id){
                $msg = 'selected';
            }else{
                $msg = '';
            }
            $output .= '<option value="'.$data->id.'" '.$msg.'>'.$data->title.'</option>';
        }
        return $output;
    }
    public function update(Request $request,$id){
        $data  = Rss::find($id);
        $input = $request->all();
        $data->update($input);
        $msg = 'Data Updated Successfully';
        return response()->json($msg);
    }
    public function delete($id){
        $data  = Rss::find($id)->delete();
        $msg = 'Data deleted Successfully';
        return response()->json($msg);
    }

    public function feedUpdate($id){
        $lastRecord = Rss::findOrFail($id);
        $feed = \Feeds::make($lastRecord->feed_url);

        $items = $feed->get_items(); //grab all items inside the rss
        $i =0;
        foreach($items as $item):

            if($i==$lastRecord->post_limit){
                break;
            }  

            $title =  $item->get_title(); 
            if($title){
                $titleCheck = Post::where('title',$title)->get();
                $totaltitle =  count($titleCheck);
                if($totaltitle == 0){
                    $post = new Post();
                    $post->language_id  = $lastRecord->language_id;
                    $post->title        = $title;
                    $post->slug         = slug_create($title);
                    $post->post_type    = 'rss';
                    $post->is_feature   = 0;
                    $post->is_slider    = 0;
                    $post->slider_left  = 0;
                    $post->slider_right = 0;
                    $post->is_trending  = 0;
                    $post->description  = $item->get_description();
    
                    if ($enclosure = $item->get_enclosure(0)) {
        
                        $type = $enclosure->get_real_type();
                        // Is it a Image?
                        if (stristr($type, 'image/')) {
                            if (empty($enclosure)) {
                                $post->rss_image = '';
                            }
                        $post->rss_image = $enclosure->get_link();
                        }
                    }
                    $post->category_id        = $lastRecord->category_id;
                    $post->schedule_post      = 0;
                    $post->schedule_post      = 0;
                    $post->schedule_post_date = NULL;
                    $post->is_pending         = 0;
                    $post->admin_id           = 1;
                    $post->status             = true;
                    $post->is_draft           = 0;
                    $post->rss_link           = $item->get_permalink();
                    $post->save();
                }
                
            }
                $i++;
        endforeach;

       Toastr::success('Data Updated Successfully');
       return redirect()->back();
    }
}
