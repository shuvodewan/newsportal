<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['language_id','title','slug','parent_id','color','category_order','show_at_homepage','show_on_menu'];
    protected $table    = 'categories';

    public $timestamps  = false;

    public function parent(){
        return $this->belongsTo('App\Models\Category','parent_id')->withDefault(function ($data) {
            foreach($data->getFillable() as $dt){
                $data[$dt] = __('Deleted');
            }
        });
    }
    public function child(){
        return $this->hasMany('App\Models\Category','parent_id');
    }

    public function posts(){
        return $this->hasMany('App\Models\Post','category_id');
    }

    public function subcategoryPosts(){
        return $this->hasMany('App\Models\Post','subcategories_id');
    }

    public function language(){
        return $this->belongsTo('App\Models\Language')->withDefault(function ($data) {
            foreach($data->getFillable() as $dt){
                $data[$dt] = __('Deleted');
            }
        });
    }
    public function rss(){
        return $this->hasMany('App\Models\Rss','category_id');
    }
}
