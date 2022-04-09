<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\Post;

class GalleryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function show()
    {
        $data[0] = 0;
        $id = $_GET['id'];
        $post = Post::findOrFail($id);
        if(count($post->galleries))
        {
            $data[0] = 1;
            $data[1] = $post->galleries;
        }
        return response()->json($data);              
    }  

    public function store(Request $request)
    { 
        $data = null;
        $lastid = $request->post_id;
        if ($files = $request->file('gallery')){
            foreach ($files as  $key => $file){
                $val = $file->getClientOriginalExtension();
                if($val == 'jpeg'|| $val == 'jpg'|| $val == 'png'|| $val == 'svg')
                  {                    
                    $gallery = new Gallery;
                    $name = time().$file->getClientOriginalName();
                    $file->move('assets/images/galleries',$name);
                    $gallery['photo'] = $name;
                    $gallery['post_id'] = $lastid;
                    $gallery->save();
                    $data[] = $gallery;   
                  }
            }
        }
        return response()->json($data);      
    } 

    public function destroy()
    {
        $id = $_GET['id'];
        $gal = Gallery::findOrFail($id);
        @unlink('assets/images/galleries/'.$gal->photo);
        $gal->delete();
            
    } 
}
