<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rss extends Model
{
    protected $fillable = ['language_id','feed_name','feed_url','post_limit','category_id','auto_update',];
    protected $table    = 'rss_feeds';

    public function language(){
        return $this->belongsTo('App\Models\Language')->withDefault(function ($data) {
            foreach($data->getFillable() as $dt){
                $data[$dt] = __('Deleted');
            }
        });
    }
    public function category(){
        return $this->belongsTo(('App\Models\Category'))->withDefault(function ($data) {
            foreach($data->getFillable() as $dt){
                $data[$dt] = __('Deleted');
            }
        });
    }
}
