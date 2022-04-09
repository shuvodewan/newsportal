<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Follow;
use Toastr;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{
    public function followerCreate($id){
        $auth_id = Auth::guard('admin')->user();
        $follower_id = $id;
        if($auth_id){
            if($auth_id->id == $follower_id){
                Toastr::error('You cann,t follow yourself');
                return redirect()->back();
            }else{
                $followOrNot = Follow::where('admin_id',$follower_id)->where('follower_id',$auth_id->id)->first();
                if(empty($followOrNot)){
                    $follow = new Follow();
                    $follow->admin_id = $follower_id;
                    $follow->follower_id = $auth_id->id;
                    $follow->save();
                    Toastr::success('You following from now');
                    return redirect()->back();
                }else{
                    Toastr::info('You already following!');
                    return redirect()->back();
                }
            }
        }else{
            return redirect()->intended(route('front.LogReg'));
        }
    }

    public function following($admin){
        $admin = Admin::where('name',$admin)->first();
        $data['admin'] = $admin;
        $data['followers'] = Admin::find($admin->id)->followers;
        $data['all_posts'] = Admin::find($admin->id)->posts;
        return view('frontend.follower',$data);
    }
}
