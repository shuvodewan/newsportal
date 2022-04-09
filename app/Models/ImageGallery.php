<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImageGallery extends Model
{
    protected $fillable = ['language_id','image_album_id','image_category_id','gallery'];
    protected $table    = 'image_galleries';
    public $timestamps  = false;

    public function language(){
        return $this->belongsTo('App\Models\Language')->withDefault(function ($data) {
            foreach($data->getFillable() as $dt){
                $data[$dt] = __('Deleted');
            }
        });
    }
    public function album(){
        return $this->belongsTo('App\Models\ImageAlbum','image_album_id')->withDefault(function ($data) {
            foreach($data->getFillable() as $dt){
                $data[$dt] = __('Deleted');
            }
        });
    }
    public function category(){
        return $this->belongsTo('App\Models\ImageCategory','image_category_id')->withDefault(function ($data) {
            foreach($data->getFillable() as $dt){
                $data[$dt] = __('Deleted');
            }
        });
    }
}
