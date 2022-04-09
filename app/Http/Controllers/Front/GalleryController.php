<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ImageAlbum;

class GalleryController extends Controller
{
    public function view($x){
        $data['gallery'] = ImageAlbum::findOrFail($x); 
        return view('frontend.gallery_view',$data);
    }
}
