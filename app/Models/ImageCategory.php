<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImageCategory extends Model
{
    protected $fillable = ['language_id','image_album_id','name'];
    protected $table    = 'image_categories';
    public $timestamps  = false;

    public function language(){
        return $this->belongsTo('App\Models\Language');
    }
    public function album(){
        return $this->belongsTo('App\Models\ImageAlbum','image_album_id');
    }
    public function galleries(){
        return $this->hasMany('App\Models\ImageGallery','image_category_id');
    }
}
