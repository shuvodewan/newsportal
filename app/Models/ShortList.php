<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShortList extends Model
{
    protected $fillable = ['post_id','item_title','item_photo','item_description'];
    protected $table    = 'short_lists';

    public $timestamps  = false;


    public function parent(){
        return $this->belongsTo('App\Models\Post')->withDefault(function ($data) {
            foreach($data->getFillable() as $dt){
                $data[$dt] = __('Deleted');
            }
        });
    }
}
