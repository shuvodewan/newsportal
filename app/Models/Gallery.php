<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $fillable = ['post_id','photo'];
    protected $table    = 'galleries';

    public $timestamps  = false;

    public function post(){
        return $this->belongsTo('App\Models\Post')->withDefault(function ($data) {
            foreach($data->getFillable() as $dt){
                $data[$dt] = __('Deleted');
            }
        });
    }
}
