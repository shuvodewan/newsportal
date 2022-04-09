<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Post;

class SiteMapController extends Controller
{
    public function index()
    {
      return response()->view('sitemap.index')->header('Content-Type', 'text/xml');
    }

    public function posts()
    {

        $posts = Post::where('is_pending','=',0)->where('status','=',true)->where('schedule_post','=',0)->latest()->get();
        return response()->view('sitemap.posts', [
            'posts' => $posts,
        ])->header('Content-Type', 'text/xml');

    }
}
