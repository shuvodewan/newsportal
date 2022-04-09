<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PersonalityQuestion extends Model
{
    protected $fillable = ['post_id','question_title','personality_result_id','question_photo','question_description'];
    protected $table    = 'personality_questions';
    public $timestamps  = false;


    public function parent(){
        return $this->belongsTo('App\Models\Post')->withDefault(function ($data) {
            foreach($data->getFillable() as $dt){
                $data[$dt] = __('Deleted');
            }
        });
    }

    public function answers(){
        return $this->hasMany('App\Models\PersonalityAnswer');
    }
}
