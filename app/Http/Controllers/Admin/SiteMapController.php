<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use View;
use Illuminate\Http\Response;

class SiteMapController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function all()
    {
        return view('admin.generalsettings.sitemap');
    }

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

    public function categories()
    {
        $categories = Category::where('parent_id','=',NULL)->orderBy('id','desc')->get();
        return response()->view('sitemap.categories', [
            'categories' => $categories,
        ])->header('Content-Type', 'text/xml');
    }

    public function subcategories()
    {
        $subcategories = Category::where('parent_id','!=',NULL)->orderBy('id','desc')->get();
        return response()->view('sitemap.subcategories', [
            'subcategories' => $subcategories,
        ])->header('Content-Type', 'text/xml');
    }
}
