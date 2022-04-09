<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PersonalityResult extends Model
{
    protected $fillable = ['post_id','result_title','result_photo','result_description'];
    protected $table    = 'personality_results';
    public $timestamps  = false;

    public function parent(){
        return $this->belongsTo('App\Models\Post')->withDefault(function ($data) {
            foreach($data->getFillable() as $dt){
                $data[$dt] = __('Deleted');
            }
        });
    }
}
