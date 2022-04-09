<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Language;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class QuisController extends Controller
{
    public function create(){
        $datas = Category::where('parent_id','=',NULL)->get();
        $languages = Language::orderBy('id','desc')->get();
        return view('admin.quiz.create',compact('datas','languages'));
    }
}
