<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TriviaQuestion extends Model
{
    protected $fillable = ['post_id','question_title','question_photo','question_description'];
    protected $table    = 'trivia_questions';
    public $timestamps  = false;


    public function parent(){
        return $this->belongsTo('App\Models\Post')->withDefault(function ($data) {
            foreach($data->getFillable() as $dt){
                $data[$dt] = __('Deleted');
            }
        });
    }

    public function answers(){
        return $this->hasMany('App\Models\TriviaAnswer');
    }
}
