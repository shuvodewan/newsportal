<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $fillable = ['is_default','language','file','name','rtl','status'];
    protected $table    = 'languages';

    public $timestamps  = false;

    public function categories(){
        return $this->hasMany('App\Models\Category','language_id');
    }
    public function posts(){
        return $this->hasMany('App\Models\Post','language_id');
    }
    public function polls(){
        return $this->hasMany('App\Models\PollQuestion','language_id');
    }
    public function albums(){
        return $this->hasMany('App\Models\ImageAlbum','language_id');
    }
    public function galleries(){
        return $this->hasMany('App\Models\ImageGallery','language_id');
    }
    public function pages(){
        return $this->hasMany('App\Models\Page','language_id');
    }
    public function rss(){
        return $this->hasMany('App\Models\Rss','language_id');
    }
    public function widgets(){
        return $this->hasMany('App\Models\Widget','language_id');
    }
    public function logos(){
        return $this->hasMany('App\Models\Logo','language_id');
    }
}
